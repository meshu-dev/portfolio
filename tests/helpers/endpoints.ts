import { registerEndpoint } from '@nuxt/test-utils/runtime'
import { createError, defineEventHandler } from 'h3'

/**
 * Registers a Nuxt server route for the test file. The response can be changed between tests, and a
 * response of `null` makes the route fail with a 500 like an unreachable portfolio API would.
 */
export const registerJsonEndpoint = <T>(path: string, initial: T | null) => {
  let response: T | null = initial

  registerEndpoint(
    path,
    defineEventHandler(() => {
      if (response === null) {
        throw createError({ statusCode: 500, statusMessage: 'Server Error' })
      }

      return response
    })
  )

  return {
    respondWith: (next: T | null) => {
      response = next
    }
  }
}
