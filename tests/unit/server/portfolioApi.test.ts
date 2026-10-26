import { beforeEach, describe, expect, it } from 'vitest'
import { registerEndpoint } from '@nuxt/test-utils/runtime'
import { createError, defineEventHandler, getHeader, readBody } from 'h3'
import { clearPortfolioApiTokens, fetchPortfolioApi } from '../../../server/utils/portfolioApi'

const config = { apiUrl: '/mock-api', email: 'alex@example.com', password: 'secret' }

type Recorded = { body?: unknown; authorization?: string }

const loginRequests: Recorded[] = []
const dataRequests: Recorded[] = []
let loginShouldFail = false
let issuedTokens = 0
let acceptedToken = 'abc-token-1'

registerEndpoint('/mock-api/auth/login', {
  method: 'POST',
  handler: defineEventHandler(async (event) => {
    loginRequests.push({ body: await readBody(event) })

    if (loginShouldFail) {
      throw createError({ statusCode: 401, statusMessage: 'Unauthorized' })
    }

    issuedTokens++

    return { data: { token: `abc-token-${issuedTokens}` } }
  })
})

registerEndpoint('/mock-api/portfolio/livestreams', {
  method: 'GET',
  handler: defineEventHandler((event) => {
    const authorization = getHeader(event, 'authorization')
    dataRequests.push({ authorization })

    if (authorization !== `Bearer ${acceptedToken}`) {
      throw createError({ statusCode: 401, statusMessage: 'Unauthorized' })
    }

    return { data: [{ title: 'Coding with Claude AI' }] }
  })
})

describe('fetchPortfolioApi', () => {
  beforeEach(() => {
    loginRequests.length = 0
    dataRequests.length = 0
    loginShouldFail = false
    issuedTokens = 0
    acceptedToken = 'abc-token-1'
    clearPortfolioApiTokens()
  })

  it('logs in with the configured credentials, then requests the path with the bearer token', async () => {
    // Act
    const result = await fetchPortfolioApi(config, '/portfolio/livestreams')

    // Assert
    expect(result).toStrictEqual({ data: [{ title: 'Coding with Claude AI' }] })
    expect(loginRequests).toStrictEqual([{ body: { email: 'alex@example.com', password: 'secret' } }])
    expect(dataRequests).toStrictEqual([{ authorization: 'Bearer abc-token-1' }])
  })

  it('does not request the path when the login fails', async () => {
    // Arrange
    loginShouldFail = true

    // Act
    const request = fetchPortfolioApi(config, '/portfolio/livestreams')

    // Assert
    await expect(request).rejects.toThrow('401')
    expect(dataRequests).toHaveLength(0)
  })

  it('logs in once and reuses the token for later requests', async () => {
    // Act
    await fetchPortfolioApi(config, '/portfolio/livestreams')
    await fetchPortfolioApi(config, '/portfolio/livestreams')

    // Assert
    expect(loginRequests).toHaveLength(1)
    expect(dataRequests).toHaveLength(2)
  })

  it('shares one login between requests that arrive together', async () => {
    // Act
    await Promise.all([
      fetchPortfolioApi(config, '/portfolio/livestreams'),
      fetchPortfolioApi(config, '/portfolio/livestreams')
    ])

    // Assert
    expect(loginRequests).toHaveLength(1)
  })

  it('logs in again and retries once when the API rejects the saved token', async () => {
    // Arrange
    await fetchPortfolioApi(config, '/portfolio/livestreams')
    acceptedToken = 'abc-token-2'

    // Act
    const result = await fetchPortfolioApi(config, '/portfolio/livestreams')

    // Assert
    expect(result).toStrictEqual({ data: [{ title: 'Coding with Claude AI' }] })
    expect(loginRequests).toHaveLength(2)
    expect(dataRequests.map((request) => request.authorization)).toStrictEqual([
      'Bearer abc-token-1',
      'Bearer abc-token-1',
      'Bearer abc-token-2'
    ])
  })

  it('gives up when the retry is rejected too', async () => {
    // Arrange
    acceptedToken = 'never'

    // Act
    const request = fetchPortfolioApi(config, '/portfolio/livestreams')

    // Assert
    await expect(request).rejects.toThrow('401')
    expect(loginRequests).toHaveLength(2)
  })

  it('does not remember a failed login', async () => {
    // Arrange
    loginShouldFail = true
    await fetchPortfolioApi(config, '/portfolio/livestreams').catch(() => undefined)
    loginShouldFail = false

    // Act
    const result = await fetchPortfolioApi(config, '/portfolio/livestreams')

    // Assert
    expect(result).toStrictEqual({ data: [{ title: 'Coding with Claude AI' }] })
  })
})
