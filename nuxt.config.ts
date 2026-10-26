// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  compatibilityDate: '2025-07-15',
  devtools: { enabled: true },
  modules: ['@nuxt/ui', '@nuxtjs/turnstile', '@nuxt/eslint'],
  css: ['~/assets/css/main.css'],
  runtimeConfig: {
    portfolioApiEmail: process.env.PORTFOLIO_API_EMAIL,
    portfolioApiPassword: process.env.PORTFOLIO_API_PASSWORD,
    turnstile: {
      secretKey: process.env.CLOUDFLARE_TURNSTILE_SECRET_KEY,
    },
    public: {
      cvUrl: process.env.NUXT_PUBLIC_CV_URL,
      portfolioApiUrl: process.env.NUXT_PUBLIC_PORTFOLIO_API_URL,
    },
  },
  turnstile: {
    siteKey: process.env.CLOUDFLARE_TURNSTILE_SITE_KEY,
  },
  routeRules: {
    // Rendered on the server and cached there for a day; once it expires, the old page is served
    // while a fresh one is rendered in the background
    '/': { swr: 60 * 60 * 24 },
    '/livecoding': { swr: 60 * 60 * 24 },
    // The routes the pages call for their data. Cached for an hour, so browsing between pages
    // does not log in to the portfolio API on every click.
    '/api/livestreams': { swr: 60 * 60 },
    '/api/latest-livestream': { swr: 60 * 60 },
    // Generated once at build time
    '/about': { prerender: true },
    '/projects': { prerender: true },
    '/contact': { prerender: true },
  },
})