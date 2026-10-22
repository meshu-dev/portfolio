import { describe, expect, it } from 'vitest'
import { mountSuspended } from '@nuxt/test-utils/runtime'
import GitRepoButton from '~/components/GitRepoButton.vue'
import type { Repository } from '~/types/Portfolio'

const starterPortfolio: Repository = { name: 'Starter Portfolio', url: 'https://github.com/example/starter-portfolio' }
const starterApi: Repository = { name: 'Starter API', url: 'https://github.com/example/starter-api' }

describe('GitRepoButton', () => {
  it('renders nothing when there are no repositories', async () => {
    // Act
    const wrapper = await mountSuspended(GitRepoButton, { props: { repositories: null } })

    // Assert
    expect(wrapper.text()).toBe('')
    expect(wrapper.find('a, button').exists()).toBe(false)
  })

  it('renders nothing for an empty list', async () => {
    // Act
    const wrapper = await mountSuspended(GitRepoButton, { props: { repositories: [] } })

    // Assert
    expect(wrapper.find('a, button').exists()).toBe(false)
  })

  it('links straight to the repository when there is only one', async () => {
    // Act
    const wrapper = await mountSuspended(GitRepoButton, { props: { repositories: [starterPortfolio] } })
    const link = wrapper.find('a')

    // Assert
    expect(link.text()).toBe('Github')
    expect(link.attributes('href')).toBe(starterPortfolio.url)
    expect(link.attributes('target')).toBe('_blank')
  })

  it('offers a menu of repositories when there are several', async () => {
    // Act
    const wrapper = await mountSuspended(GitRepoButton, {
      props: { repositories: [starterPortfolio, starterApi] }
    })

    // Assert
    expect(wrapper.find('button').text()).toBe('Github')
    expect(wrapper.find('a').exists()).toBe(false)
    expect((wrapper.vm as unknown as { options: { label: string; to: string }[] }).options).toStrictEqual([
      { label: 'Starter Portfolio', to: starterPortfolio.url, target: '_blank' },
      { label: 'Starter API', to: starterApi.url, target: '_blank' }
    ])
  })
})
