// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  compatibilityDate: '2025-07-15',
  devtools: { enabled: true },
  modules: ['@nuxt/ui', '@nuxtjs/turnstile'],
  css: ['~/assets/css/main.css'],
  runtimeConfig: {
    portfolioApiEmail: process.env.PORTFOLIO_API_EMAIL,
    portfolioApiPassword: process.env.PORTFOLIO_API_PASSWORD,
    turnstile: {
      secretKey: process.env.CLOUDFLARE_TURNSTILE_SECRET_KEY,
    },
    public: {
      portfolioApiUrl: process.env.NUXT_PUBLIC_PORTFOLIO_API_URL,
    },
  },
  turnstile: {
    siteKey: process.env.CLOUDFLARE_TURNSTILE_SITE_KEY,
  },
})