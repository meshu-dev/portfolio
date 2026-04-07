<script setup lang="ts">
import { Head } from '@inertiajs/vue3'
import 'vue-sonner/style.css'
import { Toaster } from '@/components/ui/sonner'
import { toast } from 'vue-sonner'
import { router } from '@inertiajs/vue3'
import { onUnmounted } from 'vue'

onUnmounted(
  router.on('flash', (event) => {
      if (event.detail.flash['message']) {
        toast(event.detail.flash['message'])
      }
  })
)
</script>

<template>
  <Head title="Portfolio Admin">
    <meta name="description" content="Your page description">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  </Head>
  <main class="bg-(--auth-background) w-full h-full m-0 pt-10 grow">
    <slot />
  </main>
  <Toaster position="top-center"
  />
</template>
