import { beforeEach, describe, expect, it } from 'vitest'
import { getAbout, getIntro, getProjects, getSiteData } from '~/utils/state'
import { makePortfolio } from '../../fixtures/portfolio'
import { setSiteData } from '../../helpers/site-data'

describe('state helpers', () => {
  beforeEach(() => {
    setSiteData(undefined)
  })

  it('returns the portfolio data stored under siteData', () => {
    // Arrange
    const portfolio = makePortfolio()
    setSiteData(portfolio)

    // Act
    const result = getSiteData()

    // Assert
    expect(result).toStrictEqual(portfolio)
  })

  it('returns each section of the portfolio', () => {
    // Arrange
    const portfolio = makePortfolio()
    setSiteData(portfolio)

    // Act
    const sections = [getIntro(), getAbout(), getProjects()]

    // Assert
    expect(sections).toStrictEqual([portfolio.data.intro, portfolio.data.about, portfolio.data.projects])
  })

  it('returns null for every section when no data has been loaded', () => {
    // Act
    const sections = [getIntro(), getAbout(), getProjects()]

    // Assert
    expect(sections).toStrictEqual([null, null, null])
  })

  it('returns null for a section the API did not send', () => {
    // Arrange
    setSiteData({ data: { intro: null, about: null, projects: null } })

    // Act
    const sections = [getIntro(), getAbout(), getProjects()]

    // Assert
    expect(sections).toStrictEqual([null, null, null])
  })
})
