<script setup lang="ts">
  defineProps<{
    title: string
    description?: string
  }>()
</script>

<template>
  <header class="mb-12 sm:mb-16">
    <h1 class="text-5xl sm:text-7xl font-extrabold tracking-tight leading-[0.95] text-highlighted">{{ title }}</h1>
    <p v-if="description" class="mt-5 max-w-xl text-xl font-serif text-toned">{{ description }}</p>
  </header>
</template>
