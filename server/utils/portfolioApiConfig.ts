import type { RuntimeConfig } from 'nuxt/schema'
import type { PortfolioApiConfig } from './portfolioApi'

export const getPortfolioApiConfig = function (config: RuntimeConfig): PortfolioApiConfig {
  return {
    apiUrl: config.public.portfolioApiUrl,
    email: config.portfolioApiEmail,
    password: config.portfolioApiPassword
  }
}
