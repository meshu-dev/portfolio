import { beforeEach, describe, expect, it, vi } from 'vitest'
import { registerEndpoint } from '@nuxt/test-utils/runtime'
import { createError, defineEventHandler, getHeader, readBody } from 'h3'
import type { RuntimeConfig } from 'nuxt/schema'
import { fetchPortfolio, fetchToken, sendMessage } from '~/utils/api'
import { makePortfolio } from '../../fixtures/portfolio'

const config = {
  portfolioApiEmail: 'alex@example.com',
  portfolioApiPassword: 'secret',
  public: { portfolioApiUrl: '/mock-api' }
} as unknown as RuntimeConfig

type Recorded = { body?: unknown; authorization?: string }

const loginRequests: Recorded[] = []
const portfolioRequests: Recorded[] = []
const contactRequests: Recorded[] = []
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

registerEndpoint('/mock-api/portfolio', {
  method: 'GET',
  handler: defineEventHandler((event) => {
    portfolioRequests.push({ authorization: getHeader(event, 'authorization') })

    return makePortfolio()
  })
})

registerEndpoint('/mock-api/contact', {
  method: 'POST',
  handler: defineEventHandler(async (event) => {
    contactRequests.push({ body: await readBody(event) })

    return { message: 'sent' }
  })
})

describe('api helpers', () => {
  beforeEach(() => {
    loginRequests.length = 0
    portfolioRequests.length = 0
    contactRequests.length = 0
    loginShouldFail = false
    vi.spyOn(console, 'log').mockImplementation(() => undefined)
  })

  describe('fetchToken', () => {
    it('logs in with the configured credentials and returns the token', async () => {
      // Act
      const token = await fetchToken(config)

      // Assert
      expect(token).toBe('abc-token')
      expect(loginRequests).toStrictEqual([{ body: { email: 'alex@example.com', password: 'secret' } }])
    })

    it('lets a failed login reject', async () => {
      // Arrange
      loginShouldFail = true

      // Act & Assert
      await expect(fetchToken(config)).rejects.toThrow('401')
    })
  })

  describe('fetchPortfolio', () => {
    it('logs in, then requests the portfolio with the bearer token', async () => {
      // Act
      const portfolio = await fetchPortfolio(config)

      // Assert
      expect(portfolio).toStrictEqual(makePortfolio())
      expect(loginRequests).toHaveLength(1)
      expect(portfolioRequests).toStrictEqual([{ authorization: 'Bearer abc-token' }])
    })

    it('does not request the portfolio when the login fails', async () => {
      // Arrange
      loginShouldFail = true

      // Act
      const request = fetchPortfolio(config)

      // Assert
      await expect(request).rejects.toThrow('401')
      expect(portfolioRequests).toHaveLength(0)
    })
  })

  describe('sendMessage', () => {
    it('posts the message to the contact endpoint and returns the response', async () => {
      // Arrange
      const payload = { name: 'Sam', email: 'sam@example.com', message: 'Hi there', token: 'turnstile' }

      // Act
      const response = await sendMessage(config, payload)

      // Assert
      expect(response).toStrictEqual({ message: 'sent' })
      expect(contactRequests).toStrictEqual([{ body: payload }])
    })
  })
})
