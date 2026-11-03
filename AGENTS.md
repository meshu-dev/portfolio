# AGENTS.md

Nuxt 4 site for a personal portfolio. It is a frontend for the Laravel [Portfolio Admin](https://github.com/meshu-dev/portfolio-admin) API and has no database of its own.

## Commands

```bash
npm run dev            # dev server on http://localhost:3000
npm run build          # production build (needs the API running, see Rendering)
npm run lint           # ESLint (lint:fix to fix)
npm run format:check   # Prettier (format to fix)
npm test               # Vitest (test:coverage for coverage)
```

Before finishing a change, run lint, format:check and test:coverage. CI runs the same four checks plus the build.

## Stack

Nuxt 4, Vue 3, Nuxt UI 4, Tailwind 4, TypeScript. Tests use Vitest with `@nuxt/test-utils` (`environment: 'nuxt'`, happy-dom).

## Layout

- `app/pages`: `index`, `about`, `projects`, `livecoding`, `contact`.
- `app/components`, `app/layouts`, `app/enums`, `app/types`.
- `app/utils`: auto-imported helpers. `api.ts` holds the browser-side calls, `state.ts` the getters for the shared site data, `date.ts` the date formatting.
- `server/api`: Nitro routes the pages call for livestream data (`/api/livestreams`, `/api/latest-livestream`).
- `server/utils`: `portfolioApi.ts` logs in to the Laravel API (the token is kept in memory) and makes the request. `portfolioApiConfig.ts` reads the runtime config.
- `tests/unit` mirrors `app` and `server`. Shared fixtures are in `tests/fixtures` and helpers in `tests/helpers`.

## Rendering

Rendering is set per route in `routeRules` in `nuxt.config.ts`:

- `/` and `/livecoding` are server-rendered and cached for a day (`swr`).
- `/about`, `/projects` and `/contact` are prerendered at build time.
- `/api/livestreams` and `/api/latest-livestream` are cached for an hour.

Consequences:

- The site needs a Node server (`node .output/server/index.mjs`), not only `nuxt generate`.
- The build calls the Laravel API, so `NUXT_PUBLIC_PORTFOLIO_API_URL`, `PORTFOLIO_API_EMAIL` and `PORTFOLIO_API_PASSWORD` must be set (CI passes them as secrets).
- The API email and password are private runtime config, so they exist only on the server. Browser code cannot call Laravel directly. Add a route in `server/api` that goes through `fetchPortfolioApi`.
- In dev, a stale page or API response is usually Nitro's route cache. Delete `.nuxt/cache/nitro/routes` and reload.

## Conventions

- Prettier: no semicolons, single quotes, no trailing commas, 120 columns. ESLint uses `@nuxt/eslint` with `eslint-config-prettier` last.
- Tests are named `*.test.ts` and each one has `// Arrange`, `// Act` and `// Assert` comments.
- To mock an API call in a test, use `registerJsonEndpoint` from `tests/helpers/endpoints.ts`. Do not stub `$fetch`, and do not mock `useRuntimeConfig` globally, because that breaks the Nuxt test environment. Pass the config to the function instead, as `getPortfolioApiConfig` does.
- Coverage thresholds are 80% on all four metrics. `server/api` handlers are excluded because they are one-line wrappers, so keep logic out of them and put it in `server/utils`.
- Do not commit `.env` or any secrets. Ask before adding a dependency.
- Branch names start with `feature/` or `bug/`. Do not commit to `main`.
