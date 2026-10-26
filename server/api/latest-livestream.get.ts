import type { LastStreamedResponse } from '../../app/types/Portfolio'

export default defineEventHandler((event) =>
  fetchPortfolioApi<LastStreamedResponse>(
    getPortfolioApiConfig(useRuntimeConfig(event)),
    '/portfolio/livestreams/latest'
  )
)
