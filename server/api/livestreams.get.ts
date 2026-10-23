import type { LivestreamsResponse } from '../../app/types/Portfolio'

export default defineEventHandler((event) =>
  fetchPortfolioApi<LivestreamsResponse>(getPortfolioApiConfig(useRuntimeConfig(event)), '/portfolio/livestreams')
)
