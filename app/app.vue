<script setup lang="ts">
import type { RuntimeConfig } from 'nuxt/schema'

const siteData = useState('siteData')

await callOnce(async () => {
  const config: RuntimeConfig = useRuntimeConfig()
  siteData.value = await fetchPortfolio(config)
})
</script>

<template>
  <UApp>
    <NuxtLayout>
      <NuxtPage />
    </NuxtLayout>
  </UApp>
</template>
