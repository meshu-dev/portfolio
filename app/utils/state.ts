import type { About, Intro, Livestream, PortfolioResponse, Project } from '~/types/Portfolio'

export const getSiteData = function (): PortfolioResponse {
  const config = useState('siteData')
  return config.value as PortfolioResponse
}

export const getIntro = function (): Intro | null {
  const response: PortfolioResponse = getSiteData()
  return response?.data.intro || null
}

export const getAbout = function (): About | null {
  const response: PortfolioResponse = getSiteData()
  return response?.data.about || null
}

export const getProjects = function (): Project[] | null {
  const response: PortfolioResponse = getSiteData()
  return response?.data.projects || null
}

export const getLivestreams = function (): Livestream[] | null {
  const response: PortfolioResponse = getSiteData()
  return response?.data.livestreams || null
}
