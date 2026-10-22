import { describe, expect, it } from 'vitest'
import { LivestreamStatus } from '~/enums/LivestreamStatus'

describe('LivestreamStatus', () => {
  it('uses the values sent by the API', () => {
    // Act
    const values = [LivestreamStatus.Live, LivestreamStatus.Upcoming, LivestreamStatus.Completed]

    // Assert
    expect(values).toStrictEqual(['live', 'upcoming', 'completed'])
  })
})
