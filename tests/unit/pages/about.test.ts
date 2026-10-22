import { afterEach, describe, expect, it } from 'vitest'
import { mountSuspended } from '@nuxt/test-utils/runtime'
import About from '~/pages/about.vue'
import { makePortfolio } from '../../fixtures/portfolio'
import { setSiteData } from '../../helpers/site-data'

describe('About page', () => {
  afterEach(() => setSiteData(undefined))

  it('shows the heading, the bio as formatted text and the skills', async () => {
    // Arrange
    setSiteData(makePortfolio())

    // Act
    const wrapper = await mountSuspended(About)

    // Assert
    expect(wrapper.find('h1').text()).toBe('About me')
    expect(wrapper.find('#about-text').findAll('p').map((paragraph) => paragraph.text())).toStrictEqual([
      'I am a full-stack developer.',
      'I enjoy solving practical problems.'
    ])
    expect(wrapper.find('h2').text()).toBe('Skills')
    expect(wrapper.findAll('li').map((item) => item.text())).toStrictEqual(['PHP', 'Laravel', 'TypeScript'])
  })

  it('shows the about image', async () => {
    // Arrange
    setSiteData(makePortfolio())

    // Act
    const wrapper = await mountSuspended(About)
    const image = wrapper.find('img')

    // Assert
    expect(image.attributes('src')).toBe('https://placehold.co/640x800')
    expect(image.attributes('alt')).toBe('About me')
  })

  it('leaves the image out when there is none', async () => {
    // Arrange
    const portfolio = makePortfolio()
    portfolio.data.about.image_url = ''
    setSiteData(portfolio)

    // Act
    const wrapper = await mountSuspended(About)

    // Assert
    expect(wrapper.find('img').exists()).toBe(false)
  })

  it('still renders the heading when the about data is missing', async () => {
    // Arrange
    setSiteData(undefined)

    // Act
    const wrapper = await mountSuspended(About)

    // Assert
    expect(wrapper.find('h1').text()).toBe('About me')
    expect(wrapper.findAll('li')).toHaveLength(0)
  })
})
