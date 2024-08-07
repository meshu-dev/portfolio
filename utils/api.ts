import type { AuthHeader, LoginDetails } from '@/types'

export const getAuthHeader = (token: string): AuthHeader => {
  return {
    'Authorization': `Bearer ${token}`
  }
}

export const getPortfolioApiUrl = (path: string): string => {
  console.log('getPortfolioApiUrl', `${process.env.API_URL}/${path}`);
  return String(`${process.env.API_URL}/${path}`)
}

export const getLoginDetails = (): LoginDetails => {
  const apiEmail: string = String(process.env.API_EMAIL)
  const apiPassword: string = String(process.env.API_PASSWORD)

  console.log('getLoginDetails', {
    "email": apiEmail,
    "password": apiPassword
  });

  return {
    "email": apiEmail,
    "password": apiPassword
  }
}