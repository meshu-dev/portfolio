import { describe, expect, it } from 'vitest'
import { mountSuspended } from '@nuxt/test-utils/runtime'
import Logo from '~/components/Logo.vue'

describe('Logo', () => {
  it('shows the site name next to the brand icon', async () => {
    // Act
    const wrapper = await mountSuspended(Logo)

    // Assert
    expect(wrapper.text()).toBe('MeshPro')
    expect(wrapper.find('span, svg').exists()).toBe(true)
  })
})
