import { afterEach, describe, expect, it } from 'vitest'
import { mountSuspended } from '@nuxt/test-utils/runtime'
import Projects from '~/pages/projects.vue'
import { makePortfolio } from '../../fixtures/portfolio'
import { setSiteData } from '../../helpers/site-data'

describe('Projects page', () => {
  afterEach(() => setSiteData(undefined))

  it('lists every project with its details', async () => {
    // Arrange
    setSiteData(makePortfolio())

    // Act
    const wrapper = await mountSuspended(Projects)
    const projects = wrapper.findAll('li')

    // Assert
    expect(wrapper.find('h1').text()).toBe('Projects')
    expect(projects).toHaveLength(2)
    expect(projects[0]!.find('h2').text()).toBe('Starter Portfolio')
    expect(projects[0]!.text()).toContain('Personal portfolio template')
    expect(projects[0]!.text()).toContain('React, Next.js, Laravel')
    expect(projects[1]!.find('h2').text()).toBe('Learning Lab')
    expect(projects[1]!.text()).toContain('Astro, Laravel')
  })

  it('shows each project image with its name as the alt text', async () => {
    // Arrange
    setSiteData(makePortfolio())

    // Act
    const wrapper = await mountSuspended(Projects)
    const image = wrapper.findAll('li')[0]!.find('img')

    // Assert
    expect(image.attributes('src')).toBe('https://placehold.co/960x600')
    expect(image.attributes('alt')).toBe('Starter Portfolio')
  })

  it('links View to the live project and offers its repositories', async () => {
    // Arrange
    setSiteData(makePortfolio())

    // Act
    const wrapper = await mountSuspended(Projects)
    const [first, second] = wrapper.findAll('li')

    // Assert
    expect(first!.find('a[href="https://portfolio.example.com"]').text()).toBe('View')
    // Two repositories become a menu button, one repository becomes a direct link.
    expect(first!.find('button').text()).toBe('Github')
    expect(second!.find('a[href="https://github.com/example/learning-lab"]').text()).toBe('Github')
  })

  it('shows just the heading when there are no projects', async () => {
    // Arrange
    setSiteData(undefined)

    // Act
    const wrapper = await mountSuspended(Projects)

    // Assert
    expect(wrapper.find('h1').text()).toBe('Projects')
    expect(wrapper.findAll('li')).toHaveLength(0)
  })
})
