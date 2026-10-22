// @ts-check
import eslintConfigPrettier from 'eslint-config-prettier/flat'
import withNuxt from './.nuxt/eslint.config.mjs'

export default withNuxt(
  {
    ignores: ['coverage/**']
  },
  // Must come last: turns off the ESLint rules that would clash with Prettier's formatting.
  eslintConfigPrettier
)
