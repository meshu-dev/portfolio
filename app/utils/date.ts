export const formatDate = function (date: string | null): string {
  if (!date) {
    return ''
  }

  return new Date(date).toLocaleDateString('en-GB', {
    day: 'numeric',
    month: 'short',
    year: 'numeric',
    timeZone: 'UTC'
  })
}

export const formatRelativeTime = function (date: string | null, now: number = Date.now()): string {
  if (!date) {
    return ''
  }

  const seconds: number = Math.trunc((new Date(date).getTime() - now) / 1000)
  const units: [Intl.RelativeTimeFormatUnit, number][] = [
    ['year', 31536000],
    ['month', 2592000],
    ['day', 86400],
    ['hour', 3600],
    ['minute', 60]
  ]

  for (const [unit, unitSeconds] of units) {
    if (Math.abs(seconds) >= unitSeconds) {
      return new Intl.RelativeTimeFormat('en', { numeric: 'always' }).format(Math.trunc(seconds / unitSeconds), unit)
    }
  }

  return 'just now'
}
