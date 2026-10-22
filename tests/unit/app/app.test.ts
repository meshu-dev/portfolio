import { describe, expect, it, vi } from 'vitest'
import { mockNuxtImport, mountSuspended } from '@nuxt/test-utils/runtime'
import { useState } from '#imports'
import App from '~/app.vue'
import { makePortfolio } from '../../fixtures/portfolio'

const { fetchPortfolioMock } = vi.hoisted(() => ({ fetchPortfolioMock: vi.fn() }))

mockNuxtImport('fetchPortfolio', () => fetchPortfolioMock)

describe('App', () => {
  it('loads the portfolio once and renders the current page in the default layout', async () => {
    // Arrange
    const portfolio = makePortfolio()
    fetchPortfolioMock.mockResolvedValue(portfolio)

    // Act
    const wrapper = await mountSuspended(App, { route: '/' })

    // Assert
    expect(fetchPortfolioMock).toHaveBeenCalledTimes(1)
    expect(useState('siteData').value).toStrictEqual(portfolio)
    expect(wrapper.find('h1').text()).toBe("Hello, I'm Alex")
    expect(wrapper.find('nav').exists()).toBe(true)
  })
})
