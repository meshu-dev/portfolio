<script setup lang="ts">
import type { RuntimeConfig } from 'nuxt/schema'
import type { ButtonProps } from '@nuxt/ui'
import type { LastStreamedResponse } from '~/types/Portfolio'

const config: RuntimeConfig = useRuntimeConfig()

const intro = getIntro()

const { data: lastStreamed } = await useFetch<LastStreamedResponse>('/api/latest-livestream')
const lastStreamedAt = lastStreamed.value?.data?.actual_end_at ?? null
const lastStreamedUrl = lastStreamed.value?.data?.url ?? null

const lastLivestreamed = formatRelativeTime(lastStreamedAt)

const links = ref<ButtonProps[]>([
  {
    label: 'Contact me',
    to: '/contact'
  },
  {
    label: 'View CV',
    to: config.public.cvUrl,
    color: 'neutral',
    variant: 'outline'
  }
])
</script>

<template>
  <section v-if="intro" class="py-6 sm:py-16">
    <h1
      class="max-w-4xl text-[clamp(3.25rem,10vw,8rem)] font-extrabold leading-[0.92] tracking-tighter text-highlighted"
    >
      {{ intro.line1 }}
    </h1>
    <p class="mt-8 max-w-2xl text-xl sm:text-2xl font-serif text-toned">{{ intro.line2 }}</p>
    <div class="mt-10 flex flex-wrap gap-3">
      <UButton v-for="(link, index) in links" :key="index" size="xl" v-bind="link" />
    </div>
    <div v-if="lastStreamedAt" class="mt-16 sm:mt-24">
      <p class="text-xl sm:text-2xl">
        <NuxtLink
          :to="lastStreamedUrl"
          target="_blank"
          rel="noopener"
          class="font-bold text-primary underline decoration-2 underline-offset-8 hover:decoration-4"
          >Last coding session</NuxtLink
        >
        <span v-if="lastLivestreamed" class="text-muted"> was {{ lastLivestreamed }}</span>
      </p>
    </div>
  </section>
</template>
