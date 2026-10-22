import { describe, expect, it } from 'vitest'
import { mountSuspended } from '@nuxt/test-utils/runtime'
import SiteLogo from '~/components/SiteLogo.vue'

describe('SiteLogo', () => {
  it('shows the site name next to the brand icon', async () => {
    // Act
    const wrapper = await mountSuspended(SiteLogo)

    // Assert
    expect(wrapper.text()).toBe('MeshPro')
    expect(wrapper.find('span, svg').exists()).toBe(true)
  })
})
