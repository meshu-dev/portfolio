import { beforeEach, describe, expect, it } from 'vitest'
import { registerEndpoint } from '@nuxt/test-utils/runtime'
import { createError, defineEventHandler, getHeader, readBody } from 'h3'
import { fetchPortfolioApi } from '../../../server/utils/portfolioApi'

const config = { apiUrl: '/mock-api', email: 'alex@example.com', password: 'secret' }

type Recorded = { body?: unknown; authorization?: string }

const loginRequests: Recorded[] = []
const dataRequests: Recorded[] = []
let loginShouldFail = false

registerEndpoint('/mock-api/auth/login', {
  method: 'POST',
  handler: defineEventHandler(async (event) => {
    loginRequests.push({ body: await readBody(event) })

    if (loginShouldFail) {
      throw createError({ statusCode: 401, statusMessage: 'Unauthorized' })
    }

    return { data: { token: 'abc-token' } }
  })
})

registerEndpoint('/mock-api/portfolio/livestreams', {
  method: 'GET',
  handler: defineEventHandler((event) => {
    dataRequests.push({ authorization: getHeader(event, 'authorization') })

    return { data: [{ title: 'Coding with Claude AI' }] }
  })
})

describe('fetchPortfolioApi', () => {
  beforeEach(() => {
    loginRequests.length = 0
    dataRequests.length = 0
    loginShouldFail = false
  })

  it('logs in with the configured credentials, then requests the path with the bearer token', async () => {
    // Act
    const result = await fetchPortfolioApi(config, '/portfolio/livestreams')

    // Assert
    expect(result).toStrictEqual({ data: [{ title: 'Coding with Claude AI' }] })
    expect(loginRequests).toStrictEqual([{ body: { email: 'alex@example.com', password: 'secret' } }])
    expect(dataRequests).toStrictEqual([{ authorization: 'Bearer abc-token' }])
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
})
