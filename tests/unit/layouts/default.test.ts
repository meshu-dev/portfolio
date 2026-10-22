import { afterEach, describe, expect, it } from 'vitest'
import { mountSuspended } from '@nuxt/test-utils/runtime'
import DefaultLayout from '~/layouts/default.vue'
import { makePortfolio } from '../../fixtures/portfolio'
import { setSiteData } from '../../helpers/site-data'

const mountLayout = (route = '/') => mountSuspended(DefaultLayout, {
  route,
  slots: { default: '<p data-test="page">Page content</p>' }
})

describe('Default layout', () => {
  afterEach(() => setSiteData(undefined))

  it('renders the page inside the layout', async () => {
    // Arrange
    setSiteData(makePortfolio())

    // Act
    const wrapper = await mountLayout()

    // Assert
    expect(wrapper.find('[data-test="page"]').text()).toBe('Page content')
  })

  it('shows the logo and a link for every page', async () => {
    // Arrange
    setSiteData(makePortfolio())

    // Act
    const wrapper = await mountLayout()
    const links = new Map(wrapper.findAll('nav a').map((link) => [link.text(), link.attributes('href')]))

    // Assert
    expect(wrapper.text()).toContain('MeshPro')
    expect(links.get('Home')).toBe('/')
    expect(links.get('About')).toBe('/about')
    expect(links.get('Projects')).toBe('/projects')
    expect(links.get('Livecoding')).toBe('/livecoding')
    expect(links.get('Contact')).toBe('/contact')
  })

  it.each([
    ['/', 'Home'],
    ['/about', 'About'],
    ['/projects', 'Projects'],
    ['/livecoding', 'Livecoding'],
    ['/contact', 'Contact']
  ])('marks %s as the current page in the menu', async (route, label) => {
    // Arrange
    setSiteData(makePortfolio())

    // Act
    const wrapper = await mountLayout(route)
    const current = wrapper.findAll('nav a').filter((link) => link.attributes('aria-current') === 'page')

    // Assert
    expect(current.map((link) => link.text())).toStrictEqual([label])
  })

  it('shows an icon link for each of the developer\'s sites', async () => {
    // Arrange
    setSiteData(makePortfolio())

    // Act
    const wrapper = await mountLayout()

    // Assert
    expect(wrapper.find('a[aria-label="GitHub"]').attributes('href')).toBe('https://github.com/example')
    expect(wrapper.find('a[aria-label="YouTube"]').attributes('href')).toBe('https://www.youtube.com/@Mesh-Pro')
    expect(wrapper.find('a[aria-label="GitHub"]').attributes('target')).toBe('_blank')
  })

  it('shows no site links when the intro is missing', async () => {
    // Arrange
    setSiteData(undefined)

    // Act
    const wrapper = await mountLayout()

    // Assert
    expect(wrapper.find('a[aria-label="GitHub"]').exists()).toBe(false)
    expect(wrapper.find('a[aria-label="YouTube"]').exists()).toBe(false)
  })

  it('shows no site links when the intro has no sites', async () => {
    // Arrange
    const portfolio = makePortfolio()
    portfolio.data.intro.sites = undefined as never
    setSiteData(portfolio)

    // Act
    const wrapper = await mountLayout()

    // Assert
    expect(wrapper.find('a[aria-label="GitHub"]').exists()).toBe(false)
  })

  it('credits the stack and shows the current year in the footer', async () => {
    // Arrange
    setSiteData(makePortfolio())

    // Act
    const wrapper = await mountLayout()
    const footer = wrapper.find('footer')

    // Assert
    expect(footer.find('a[href="https://laravel.com"]').text()).toBe('Laravel')
    expect(footer.find('a[href="https://nuxt.com"]').text()).toBe('Nuxt.js')
    expect(footer.text()).toContain(`Copyright © ${new Date().getFullYear()} Mesh Pro. All rights reserved`)
  })
})
