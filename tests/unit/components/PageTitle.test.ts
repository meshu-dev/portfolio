import { describe, expect, it } from 'vitest'
import { mountSuspended } from '@nuxt/test-utils/runtime'
import PageTitle from '~/components/PageTitle.vue'

describe('PageTitle', () => {
  it('renders the title as the page heading', async () => {
    // Act
    const wrapper = await mountSuspended(PageTitle, { props: { title: 'Projects' } })

    // Assert
    expect(wrapper.find('h1').text()).toBe('Projects')
  })

  it('does not render a description when none is given', async () => {
    // Act
    const wrapper = await mountSuspended(PageTitle, { props: { title: 'Projects' } })

    // Assert
    expect(wrapper.find('p').exists()).toBe(false)
  })

  it('renders the description under the title', async () => {
    // Act
    const wrapper = await mountSuspended(PageTitle, {
      props: { title: "Let's connect", description: 'Send me a message.' }
    })

    // Assert
    expect(wrapper.find('h1').text()).toBe("Let's connect")
    expect(wrapper.find('p').text()).toBe('Send me a message.')
  })
})
