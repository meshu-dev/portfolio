import { beforeEach, describe, expect, it, vi } from 'vitest'
import { flushPromises } from '@vue/test-utils'
import { mockNuxtImport, mountSuspended } from '@nuxt/test-utils/runtime'
import Contact from '~/pages/contact.vue'

const { sendMessageMock, toastAddMock } = vi.hoisted(() => ({
  sendMessageMock: vi.fn(),
  toastAddMock: vi.fn()
}))

mockNuxtImport('sendMessage', () => sendMessageMock)
mockNuxtImport('useToast', () => () => ({ add: toastAddMock }))

type ContactVm = { token: string | undefined; state: { name?: string; email?: string; message?: string } }

const fillIn = async (
  wrapper: Awaited<ReturnType<typeof mountSuspended>>,
  values: Partial<Record<'name' | 'email' | 'message', string>>
) => {
  const [name, email] = wrapper.findAll('input')

  if (values.name !== undefined) {
    await name!.setValue(values.name)
  }

  if (values.email !== undefined) {
    await email!.setValue(values.email)
  }

  if (values.message !== undefined) {
    await wrapper.find('textarea').setValue(values.message)
  }
}

const submit = async (wrapper: Awaited<ReturnType<typeof mountSuspended>>) => {
  await wrapper.find('form').trigger('submit')
  await flushPromises()
  await vi.waitFor(() => expect(wrapper.find('form').exists()).toBe(true))
}

describe('Contact page', () => {
  beforeEach(() => {
    sendMessageMock.mockReset().mockResolvedValue({ message: 'sent' })
    toastAddMock.mockReset()
    vi.spyOn(console, 'log').mockImplementation(() => undefined)
  })

  it('shows the heading, the invitation and the form fields', async () => {
    // Act
    const wrapper = await mountSuspended(Contact)

    // Assert
    expect(wrapper.find('h1').text()).toBe("Let's connect")
    expect(wrapper.text()).toContain("I'm always on the lookout for new opportunities")
    expect(wrapper.findAll('input')).toHaveLength(2)
    expect(wrapper.find('textarea').exists()).toBe(true)
    expect(wrapper.find('button[type="submit"]').text()).toBe('Send message')
  })

  it('asks for every field when the form is submitted empty', async () => {
    // Arrange
    const wrapper = await mountSuspended(Contact)

    // Act
    await submit(wrapper)

    // Assert
    await vi.waitFor(() => expect(wrapper.text().match(/Required/g)).toHaveLength(3))
    expect(sendMessageMock).not.toHaveBeenCalled()
    expect(toastAddMock).not.toHaveBeenCalled()
  })

  it('only flags the fields that are missing', async () => {
    // Arrange
    const wrapper = await mountSuspended(Contact)
    await fillIn(wrapper, { name: 'Sam', email: 'sam@example.com' })

    // Act
    await submit(wrapper)

    // Assert
    await vi.waitFor(() => expect(wrapper.text().match(/Required/g)).toHaveLength(1))
    expect(sendMessageMock).not.toHaveBeenCalled()
  })

  it('sends the message with the Turnstile token and then clears the form', async () => {
    // Arrange
    const wrapper = await mountSuspended(Contact)
    const vm = wrapper.vm as unknown as ContactVm
    await fillIn(wrapper, { name: 'Sam', email: 'sam@example.com', message: 'Hi there' })
    vm.token = 'turnstile-token'

    // Act
    await submit(wrapper)

    // Assert
    await vi.waitFor(() => expect(sendMessageMock).toHaveBeenCalledTimes(1))
    expect(sendMessageMock.mock.calls[0]![1]).toStrictEqual({
      name: 'Sam',
      email: 'sam@example.com',
      message: 'Hi there',
      token: 'turnstile-token'
    })
    await vi.waitFor(() =>
      expect(toastAddMock).toHaveBeenCalledWith({
        title: 'Success',
        description: 'The form has been submitted.',
        color: 'success'
      })
    )
    expect(vm.state).toStrictEqual({ name: undefined, email: undefined, message: undefined })
  })

  it('shows an error and sends nothing when the Turnstile check has not completed', async () => {
    // Arrange
    const wrapper = await mountSuspended(Contact)
    await fillIn(wrapper, { name: 'Sam', email: 'sam@example.com', message: 'Hi there' })

    // Act
    await submit(wrapper)

    // Assert
    await vi.waitFor(() =>
      expect(toastAddMock).toHaveBeenCalledWith({
        title: 'error',
        description: 'An error occurred validating submission. Please try again later.',
        color: 'error'
      })
    )
    expect(sendMessageMock).not.toHaveBeenCalled()
  })
})
