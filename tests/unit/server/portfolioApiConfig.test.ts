import { describe, expect, it } from 'vitest'
import type { RuntimeConfig } from 'nuxt/schema'
import { getPortfolioApiConfig } from '../../../server/utils/portfolioApiConfig'

describe('getPortfolioApiConfig', () => {
  it('reads the portfolio API URL and credentials from the runtime config', () => {
    // Arrange
    const runtimeConfig = {
      portfolioApiEmail: 'alex@example.com',
      portfolioApiPassword: 'secret',
      public: { portfolioApiUrl: 'https://api.example.com/api' }
    } as unknown as RuntimeConfig

    // Act
    const config = getPortfolioApiConfig(runtimeConfig)

    // Assert
    expect(config).toStrictEqual({
      apiUrl: 'https://api.example.com/api',
      email: 'alex@example.com',
      password: 'secret'
    })
  })
})
