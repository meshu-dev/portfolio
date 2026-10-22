import { afterEach, beforeEach, describe, expect, it, vi } from 'vitest'
import { mountSuspended } from '@nuxt/test-utils/runtime'
import { useRuntimeConfig } from '#imports'
import Index from '~/pages/index.vue'
import { makeLivestream, makePortfolio } from '../../fixtures/portfolio'
import { setSiteData } from '../../helpers/site-data'

describe('Home page', () => {
  beforeEach(() => {
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
    it('links to the latest livestream and says how long ago it ended', async () => {
      // Arrange
      setSiteData(makePortfolio())

      // Act
      const wrapper = await mountSuspended(Index)
      const link = wrapper.find('a[href="https://www.youtube.com/watch?v=abc123"]')

      // Assert
      expect(link.text()).toBe('Last coding session')
      expect(link.attributes('target')).toBe('_blank')
      expect(wrapper.text()).toContain('was 2 days ago')
    })

    it('counts from the start when the livestream has no end time', async () => {
      // Arrange
      setSiteData(
        makePortfolio({
          livestreams: [makeLivestream({ actual_start_at: '2026-10-14T16:45:00Z', actual_end_at: null })]
        })
      )

      // Act
      const wrapper = await mountSuspended(Index)

      // Assert
      expect(wrapper.text()).toContain('was 3 hours ago')
    })

    it('shows only the link when the livestream has no times at all', async () => {
      // Arrange
      setSiteData(
        makePortfolio({
          livestreams: [makeLivestream({ actual_start_at: null, actual_end_at: null })]
        })
      )

      // Act
      const wrapper = await mountSuspended(Index)

      // Assert
      expect(wrapper.text()).toContain('Last coding session')
      expect(wrapper.text()).not.toContain('was')
    })

    it('is left out when there are no livestreams', async () => {
      // Arrange
      setSiteData(makePortfolio({ livestreams: [] }))

      // Act
      const wrapper = await mountSuspended(Index)

      // Assert
      expect(wrapper.text()).not.toContain('Last coding session')
    })

    it('is left out when the livestreams are missing', async () => {
      // Arrange
      const portfolio = makePortfolio()
      portfolio.data.livestreams = undefined as never
      setSiteData(portfolio)

      // Act
      const wrapper = await mountSuspended(Index)

      // Assert
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
