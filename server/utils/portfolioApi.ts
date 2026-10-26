import type { AuthResponse } from '../../app/types/Auth'

export type PortfolioApiConfig = {
  apiUrl: string
  email: string
  password: string
}

// Logging in is slow (the API hashes the password), so the token is kept for the life of the server process.
// The promise is stored, so requests that arrive together share one login.
const tokens = new Map<string, Promise<string>>()

export const clearPortfolioApiTokens = function (): void {
  tokens.clear()
}

const getToken = function (config: PortfolioApiConfig): Promise<string> {
  const key = `${config.apiUrl}|${config.email}`
  let token = tokens.get(key)

  if (!token) {
    token = $fetch<AuthResponse>(`${config.apiUrl}/auth/login`, {
      method: 'POST',
      body: { email: config.email, password: config.password }
    }).then((login) => login.data.token)
    tokens.set(key, token)
    // A failed login must not be remembered, or every later request would fail too.
    token.catch(() => tokens.delete(key))
  }

  return token
}

const request = async function <T>(config: PortfolioApiConfig, path: string): Promise<T> {
  return await $fetch<T>(`${config.apiUrl}${path}`, {
    method: 'GET',
    headers: { Authorization: `Bearer ${await getToken(config)}` }
  })
}

/**
 * Requests a path from the portfolio API with a bearer token, logging in first when there is no token yet.
 * If the API rejects the token, it logs in again once and retries.
 * The credentials only exist on the server, which is why the browser goes through the Nuxt server routes.
 */
export const fetchPortfolioApi = async function <T>(config: PortfolioApiConfig, path: string): Promise<T> {
  try {
    return await request<T>(config, path)
  } catch (error) {
    if ((error as { statusCode?: number }).statusCode !== 401) {
      throw error
    }

    tokens.delete(`${config.apiUrl}|${config.email}`)

    return await request<T>(config, path)
  }
}
