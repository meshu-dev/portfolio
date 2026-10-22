<script setup lang="ts">
import type { FormError } from '@nuxt/ui'
import type { Toast } from '@nuxt/ui/runtime/composables/useToast.js'
import type { RuntimeConfig } from 'nuxt/schema'
import type { ContactPayload } from '@/types/Contact'

const state = reactive({
  name: undefined,
  email: undefined,
  message: undefined
})

const token = ref()

type Schema = typeof state

function validate(state: Partial<Schema>): FormError[] {
  const errors = []

  if (!state.name) {
    errors.push({ name: 'name', message: 'Required' })
  }

  if (!state.email) {
    errors.push({ name: 'email', message: 'Required' })
  }

  if (!state.message) {
    errors.push({ name: 'message', message: 'Required' })
  }

  return errors
}

const toast = useToast()

async function onSubmit() {
  console.log('cloudflare token', token.value, token)

  let toastData: Partial<Toast> | null = null

  if (
    state.name &&
    state.email &&
    state.message &&
    token.value
  ) {
    const config: RuntimeConfig = useRuntimeConfig()

    const payload: ContactPayload = {
      name: state.name,
      email: state.email,
      message: state.message,
      token: token.value
    } as ContactPayload

    const response = await sendMessage(
      config,
      payload
    )

    console.log('response', response)

    state.name = undefined
    state.email = undefined
    state.message = undefined

    toastData = {
      title: 'Success',
      description: 'The form has been submitted.',
      color: 'success'
    }
  } else {
    toastData = {
      title: 'error',
      description: 'An error occurred validating submission. Please try again later.',
      color: 'error',
    }
  }

  toast.add(toastData)
  return
}
</script>

<template>
  <div>
    <PageTitle
      title="Let's connect"
      description="I'm always on the lookout for new opportunities, so please send me a message and let's talk." />
    <UForm :validate="validate" :state="state" class="w-full max-w-xl space-y-6" @submit="onSubmit">
      <UFormField label="Name" name="name" class="w-full">
        <UInput v-model="state.name" size="xl" class="w-full" />
      </UFormField>
      <UFormField label="Email" name="email" class="w-full">
        <UInput v-model="state.email" size="xl" class="w-full" />
      </UFormField>
      <UFormField label="Message" name="message" class="w-full">
        <UTextarea v-model="state.message" :rows="10" size="xl" class="w-full" />
      </UFormField>
      <NuxtTurnstile v-model="token" />
      <UButton type="submit" size="xl">Send message</UButton>
    </UForm>
  </div>
</template>
