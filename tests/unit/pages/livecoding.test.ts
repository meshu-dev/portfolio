import { afterEach, describe, expect, it } from 'vitest'
import { mountSuspended } from '@nuxt/test-utils/runtime'
import Livecoding from '~/pages/livecoding.vue'
import { makeLivestream, makePortfolio } from '../../fixtures/portfolio'
import { setSiteData } from '../../helpers/site-data'

describe('Livecoding page', () => {
  afterEach(() => setSiteData(undefined))

  it('lists each livestream with its date, title link and description', async () => {
    // Arrange
    setSiteData(makePortfolio())

    // Act
    const wrapper = await mountSuspended(Livecoding)
    const rows = wrapper.findAll('li')

    // Assert
    expect(wrapper.find('h1').text()).toBe('Livecoding')
    expect(rows).toHaveLength(2)
    expect(rows[0]!.text()).toContain('12 Oct 2026')
    expect(rows[0]!.find('h2 a').text()).toBe('Coding with Claude AI')
    expect(rows[0]!.find('h2 a').attributes('href')).toBe('https://www.youtube.com/watch?v=abc123')
    expect(rows[0]!.text()).toContain('Building a small Node app that talks to the Gemini API.')
  })

  it('shows the thumbnail when there is one and leaves it out when there is not', async () => {
    // Arrange
    setSiteData(makePortfolio())

    // Act
    const wrapper = await mountSuspended(Livecoding)
    const rows = wrapper.findAll('li')

    // Assert
    expect(rows[0]!.find('img').attributes('src')).toBe('https://i.ytimg.com/vi/abc123/hqdefault.jpg')
    expect(rows[1]!.find('img').exists()).toBe(false)
  })

  it('leaves the description out when a livestream has none', async () => {
    // Arrange
    setSiteData(makePortfolio())

    // Act
    const wrapper = await mountSuspended(Livecoding)

    // Assert
    expect(wrapper.findAll('li')[1]!.find('p.font-serif').exists()).toBe(false)
  })

  it.each([[[]], [undefined]])('shows an empty message when there are no livestreams (%o)', async (livestreams) => {
    // Arrange
    setSiteData(livestreams === undefined ? undefined : makePortfolio({ livestreams }))

    // Act
    const wrapper = await mountSuspended(Livecoding)

    // Assert
    expect(wrapper.text()).toContain('No livestreams yet.')
    expect(wrapper.findAll('li')).toHaveLength(0)
  })

  describe('View More button', () => {
    it('links to the streams tab of the YouTube channel', async () => {
      // Arrange
      setSiteData(makePortfolio())

      // Act
      const wrapper = await mountSuspended(Livecoding)
      const link = wrapper.find('a[href="https://www.youtube.com/@Mesh-Pro/streams"]')

      // Assert
      expect(link.text()).toBe('View More')
      expect(link.attributes('target')).toBe('_blank')
    })

    it('does not double up a trailing slash on the channel URL', async () => {
      // Arrange
      const portfolio = makePortfolio()
      portfolio.data.intro.sites[1]!.url = 'https://www.youtube.com/@Mesh-Pro/'
      setSiteData(portfolio)

      // Act
      const wrapper = await mountSuspended(Livecoding)

      // Assert
      expect(wrapper.find('a[href="https://www.youtube.com/@Mesh-Pro/streams"]').exists()).toBe(true)
    })

    it('finds the YouTube site whatever its capitalisation', async () => {
      // Arrange
      const portfolio = makePortfolio()
      portfolio.data.intro.sites[1]!.name = 'YOUTUBE'
      setSiteData(portfolio)

      // Act
      const wrapper = await mountSuspended(Livecoding)

      // Assert
      expect(wrapper.text()).toContain('View More')
    })

    it('is hidden when there is no YouTube site', async () => {
      // Arrange
      const portfolio = makePortfolio()
      portfolio.data.intro.sites = [portfolio.data.intro.sites[0]!]
      setSiteData(portfolio)

      // Act
      const wrapper = await mountSuspended(Livecoding)

      // Assert
      expect(wrapper.text()).not.toContain('View More')
    })

    it('is hidden when the intro has no sites at all', async () => {
      // Arrange
      const portfolio = makePortfolio({ livestreams: [makeLivestream()] })
      portfolio.data.intro.sites = undefined as never
      setSiteData(portfolio)

      // Act
      const wrapper = await mountSuspended(Livecoding)

      // Assert
      expect(wrapper.text()).not.toContain('View More')
    })
  })
})
