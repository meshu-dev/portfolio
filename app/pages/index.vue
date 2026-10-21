<script setup lang="ts">
  import type { RuntimeConfig } from 'nuxt/schema'
  import type { ButtonProps } from '@nuxt/ui'
  
  const config: RuntimeConfig = useRuntimeConfig()

  const intro = getIntro()

  const latestLivestream = getLivestreams()?.[0] ?? null
  const latestLivestreamEndedAt = latestLivestream?.actual_end_at ?? latestLivestream?.actual_start_at ?? null

  // The site is statically generated, so the relative time is worked out in the browser only; baking it into the HTML would leave it stale.
  const lastLivestreamed = ref('')

  onMounted(() => {
    lastLivestreamed.value = formatRelativeTime(latestLivestreamEndedAt)
  })

  const links = ref<ButtonProps[]>([
    {
      label: 'Contact me',
      to: '/contact',
      color: 'neutral',
      variant: 'subtle',
    },
    {
      label: 'View CV',
      to: config.public.cvUrl,
      color: 'neutral',
      variant: 'subtle',
    }
  ])
</script>

<template>
  <div v-if="intro">
    <UPageHero
      class="p-0"
      :title="intro.line1"
      :description="intro.line2">
      <template #footer>
        <div class="flex flex-wrap justify-center gap-x-6 gap-y-3">
          <UButton v-for="(link, index) in links" :key="index" size="xl" v-bind="link" />
        </div>
        <p v-if="latestLivestream" class="mt-6 text-muted">
          <a
            :href="latestLivestream.url"
            target="_blank"
            rel="noopener"
            class="text-primary hover:underline underline-offset-4">Last coding session</a>
          <template v-if="lastLivestreamed"> was {{ lastLivestreamed }}</template>
        </p>
      </template>
    </UPageHero>
  </div>
</template>
