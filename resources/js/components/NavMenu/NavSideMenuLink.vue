<script setup lang="ts">
import { router } from '@inertiajs/vue3'
import type { NavLink } from '@/types/portfolio'

const props = defineProps<{ navLink: NavLink }>()
const isMenuOpen = defineModel('isMenuOpen')

const navigateToPage = () => {
  router.get(props.navLink.url)
  isMenuOpen.value = false
}
</script>

<template>
  <div class="cursor-pointer py-1" @click="navigateToPage">
    {{ navLink.name }}
  </div>
</template>
