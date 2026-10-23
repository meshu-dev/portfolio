import { defineVitestConfig } from '@nuxt/test-utils/config'

export default defineVitestConfig({
  test: {
    environment: 'nuxt',
    hookTimeout: 120000,
    testTimeout: 30000,
    environmentOptions: {
      nuxt: {
        domEnvironment: 'happy-dom'
      }
    },
    include: ['tests/**/*.test.ts'],
    coverage: {
      provider: 'v8',
      include: ['app/**/*.{ts,vue}', 'server/**/*.ts'],
      // Type-only files have no runtime code, and app.config.ts and the CSS are configuration.
      // The server/api handlers are one-line wrappers around fetchPortfolioApi, which is tested.
      exclude: ['app/types/**', 'app/app.config.ts', 'app/assets/**', 'server/api/**'],
      reporter: ['text', 'html'],
      thresholds: {
        statements: 80,
        branches: 80,
        functions: 80,
        lines: 80
      }
    }
  }
})
