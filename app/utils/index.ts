import type { AuthResponse, AuthPayload } from '~/types/Auth'
import type { About, Intro, Livestream, PortfolioResponse, Project } from '~/types/Portfolio'
import type { RuntimeConfig } from 'nuxt/schema'
import type { ContactPayload } from '@/types/Contact'

export const fetchToken = async function (config: RuntimeConfig): Promise<string> {
  const apiUrl: string = `${config.public.portfolioApiUrl}/auth/login`
  
  const payload: AuthPayload = {
    email: config.portfolioApiEmail,
    password: config.portfolioApiPassword
  }

  const response: AuthResponse = await $fetch(
    apiUrl,
    { method: 'POST', body: payload }
  )

  return response.data.token
}

export const fetchPortfolio = async function (config: RuntimeConfig): Promise<PortfolioResponse> {
  const token: string  = await fetchToken(config)
  const apiUrl: string = config.public.portfolioApiUrl

  const response: PortfolioResponse = await $fetch(
    `${apiUrl}/portfolio`,
    { method: 'GET', headers: {"Authorization": `Bearer ${token}`} }
  )

  return response as PortfolioResponse
}

export const getSiteData = function (): PortfolioResponse {
  const config = useState('siteData')
  return config.value as PortfolioResponse
}

export const getIntro = function (): Intro|null {
  const response: PortfolioResponse = getSiteData()
  return response?.data.intro || null
}

export const getAbout = function (): About|null {
  const response: PortfolioResponse = getSiteData()
  return response?.data.about || null
}

export const getProjects = function (): Project[]|null {
  const response: PortfolioResponse = getSiteData()
  return response?.data.projects || null
}

export const getLivestreams = function (): Livestream[]|null {
  const response: PortfolioResponse = getSiteData()
  return response?.data.livestreams || null
}

export const sendMessage = async function (config: RuntimeConfig, payload: ContactPayload): Promise<any> {
  const apiUrl: string = config.public.portfolioApiUrl

  const response: PortfolioResponse|any = await $fetch(
    `${apiUrl}/contact`,
    { method: 'POST', body: payload  }
  )

  console.log('response', response)

  return response
}
