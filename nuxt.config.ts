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
  vite: {
    server: {
      allowedHosts: process.env.ALLOWED_HOSTS
        ? process.env.ALLOWED_HOSTS.split(',').map((h) => h.trim())
        : [],
    },
  },
  experimental: {
    // Keep each page's data inside its HTML. Extracted, it is a second file (/livecoding/_payload.json) that the
    // swr cache stores separately from the page, and the two can go out of sync: the page renders with its
    // livestreams, then the browser loads an older payload without them and the list empties on hydration.
    payloadExtraction: false,
  },
  nitro: {
    // On Cloudflare, the swr cache is stored in KV so it is shared by all Worker instances
    // and survives restarts. Other presets keep Nitro's default cache storage.
    storage:
      process.env.NITRO_PRESET === 'cloudflare_module'
        ? { cache: { driver: 'cloudflare-kv-binding', binding: 'CACHE' } }
        : {},
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