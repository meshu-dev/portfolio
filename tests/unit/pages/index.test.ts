import { afterEach, beforeEach, describe, expect, it, vi } from 'vitest'
import { clearNuxtData, useRuntimeConfig } from '#imports'
import { mountSuspended } from '@nuxt/test-utils/runtime'
import Index from '~/pages/index.vue'
import type { LastStreamedResponse } from '~/types/Portfolio'
import { makePortfolio } from '../../fixtures/portfolio'
import { registerJsonEndpoint } from '../../helpers/endpoints'
import { setSiteData } from '../../helpers/site-data'

const lastStreamed = registerJsonEndpoint<LastStreamedResponse>('/api/last-streamed', {
  data: { actual_end_at: '2026-10-12T19:45:00Z' }
})

describe('Home page', () => {
  beforeEach(() => {
    clearNuxtData()
    lastStreamed.respondWith({ data: { actual_end_at: '2026-10-12T19:45:00Z' } })
    useRuntimeConfig().public.cvUrl = 'https://cv.example.com/alex.pdf'
    vi.useFakeTimers({ toFake: ['Date'] })
    vi.setSystemTime(new Date('2026-10-14T19:45:00Z'))
  })

  afterEach(() => {
    vi.useRealTimers()
    setSiteData(undefined)
  })

  it('introduces the developer', async () => {
    // Arrange
    setSiteData(makePortfolio())

    // Act
    const wrapper = await mountSuspended(Index)

    // Assert
    expect(wrapper.find('h1').text()).toBe("Hello, I'm Alex")
    expect(wrapper.text()).toContain("I'm a software developer with 16 years of experience")
  })

  it('links to the contact page and the CV', async () => {
    // Arrange
    setSiteData(makePortfolio())

    // Act
    const wrapper = await mountSuspended(Index)

    // Assert
    expect(wrapper.find('a[href="/contact"]').text()).toBe('Contact me')
    expect(wrapper.find('a[href="https://cv.example.com/alex.pdf"]').text()).toBe('View CV')
  })

  describe('last coding session', () => {
    it('links to the Livecoding page and says how long ago the last stream ended', async () => {
      // Arrange
      setSiteData(makePortfolio())

      // Act
      const wrapper = await mountSuspended(Index)
      const link = wrapper.find('a[href="/livecoding"]')

      // Assert
      expect(link.text()).toBe('Last coding session')
      expect(wrapper.text()).toContain('was 2 days ago')
    })

    it('counts hours for a stream that ended more recently', async () => {
      // Arrange
      setSiteData(makePortfolio())
      lastStreamed.respondWith({ data: { actual_end_at: '2026-10-14T16:45:00Z' } })

      // Act
      const wrapper = await mountSuspended(Index)

      // Assert
      expect(wrapper.text()).toContain('was 3 hours ago')
    })

    it('is left out when nothing has been streamed yet', async () => {
      // Arrange
      setSiteData(makePortfolio())
      lastStreamed.respondWith({ data: { actual_end_at: null } })

      // Act
      const wrapper = await mountSuspended(Index)

      // Assert
      expect(wrapper.text()).not.toContain('Last coding session')
    })

    it('is left out when the last streamed time cannot be loaded', async () => {
      // Arrange
      setSiteData(makePortfolio())
      lastStreamed.respondWith(null)

      // Act
      const wrapper = await mountSuspended(Index)

      // Assert
      expect(wrapper.find('h1').text()).toBe("Hello, I'm Alex")
      expect(wrapper.text()).not.toContain('Last coding session')
    })
  })

  it('renders nothing when the intro is missing', async () => {
    // Arrange
    setSiteData(undefined)

    // Act
    const wrapper = await mountSuspended(Index)

    // Assert
    expect(wrapper.find('h1').exists()).toBe(false)
  })
})
