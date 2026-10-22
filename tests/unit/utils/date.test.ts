import { describe, expect, it } from 'vitest'
import { formatDate, formatRelativeTime } from '~/utils/date'

describe('formatDate', () => {
  it('returns an empty string when there is no date', () => {
    // Act
    const results = [formatDate(null), formatDate('')]

    // Assert
    expect(results).toStrictEqual(['', ''])
  })

  it('formats an ISO date as a short British date in UTC', () => {
    // Act
    const result = formatDate('2026-10-12T17:33:00Z')

    // Assert
    expect(result).toBe('12 Oct 2026')
  })

  it('uses the UTC date even when the time is close to midnight', () => {
    // Act
    const result = formatDate('2026-01-05T23:59:00Z')

    // Assert
    expect(result).toBe('5 Jan 2026')
  })
})

describe('formatRelativeTime', () => {
  const now = Date.parse('2026-10-21T12:00:00Z')
  const secondsAgo = (seconds: number): string => new Date(now - seconds * 1000).toISOString()

  it('returns an empty string when there is no date', () => {
    // Act
    const results = [formatRelativeTime(null, now), formatRelativeTime('', now)]

    // Assert
    expect(results).toStrictEqual(['', ''])
  })

  it('says "just now" for anything under a minute', () => {
    // Arrange
    const date = secondsAgo(30)

    // Act
    const result = formatRelativeTime(date, now)

    // Assert
    expect(result).toBe('just now')
  })

  it.each([
    [60, '1 minute ago'],
    [45 * 60, '45 minutes ago'],
    [3600, '1 hour ago'],
    [23 * 3600, '23 hours ago'],
    [86400, '1 day ago'],
    [9 * 86400, '9 days ago'],
    [29 * 86400, '29 days ago'],
    [30 * 86400, '1 month ago'],
    [60 * 86400, '2 months ago'],
    [14 * 30 * 86400, '1 year ago']
  ])('formats %i seconds ago as "%s"', (seconds, expected) => {
    // Arrange
    const date = secondsAgo(seconds)

    // Act
    const result = formatRelativeTime(date, now)

    // Assert
    expect(result).toBe(expected)
  })

  it('counts forwards for dates in the future', () => {
    // Arrange
    const date = new Date(now + 2 * 3600 * 1000).toISOString()

    // Act
    const result = formatRelativeTime(date, now)

    // Assert
    expect(result).toBe('in 2 hours')
  })

  it('defaults to the current time', () => {
    // Arrange
    const date = new Date(Date.now() - 3 * 86400 * 1000).toISOString()

    // Act
    const result = formatRelativeTime(date)

    // Assert
    expect(result).toBe('3 days ago')
  })
})
