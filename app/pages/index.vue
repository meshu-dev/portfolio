<script setup lang="ts">
  import type { RuntimeConfig } from 'nuxt/schema'
  import type { ButtonProps } from '@nuxt/ui'
  
  const config: RuntimeConfig = useRuntimeConfig()

  const intro = getIntro()

  const links = ref<ButtonProps[]>([
    {
      label: 'Contact me',
      to: '/contact',
    },
    {
      label: 'View CV',
      to: config.public.cvUrl,
      color: 'neutral',
      variant: 'outline',
    }
  ])
</script>

<template>
  <section v-if="intro" class="py-6 sm:py-16">
    <h1 class="max-w-4xl text-[clamp(3.25rem,10vw,8rem)] font-extrabold leading-[0.92] tracking-tighter text-highlighted">{{ intro.line1 }}</h1>
    <p class="mt-8 max-w-2xl text-xl sm:text-2xl font-serif text-toned">{{ intro.line2 }}</p>
    <div class="mt-10 flex flex-wrap gap-3">
      <UButton v-for="(link, index) in links" :key="index" size="xl" v-bind="link" />
    </div>
  </section>
</template>
