import type { AuthResponse } from '../../app/types/Auth'

export type PortfolioApiConfig = {
  apiUrl: string
  email: string
  password: string
}

/**
 * Logs in to the portfolio API and requests a path with the bearer token.
 * The credentials only exist on the server, which is why the browser goes through the Nuxt server routes.
 */
export const fetchPortfolioApi = async function <T>(config: PortfolioApiConfig, path: string): Promise<T> {
  const login: AuthResponse = await $fetch(`${config.apiUrl}/auth/login`, {
    method: 'POST',
    body: { email: config.email, password: config.password }
  })

  return await $fetch<T>(`${config.apiUrl}${path}`, {
    method: 'GET',
    headers: { Authorization: `Bearer ${login.data.token}` }
  })
}
