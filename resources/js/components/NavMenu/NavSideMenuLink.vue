<script setup lang="ts">
import { router } from '@inertiajs/vue3'
import type { NavLink } from '@/types/portfolio'
import { HttpMethodEnum } from '@/enums/HttpMethodEnum';

const props = defineProps<{ navLink: NavLink }>()
const isMenuOpen = defineModel('isMenuOpen')

const navigateToPage = () => {
  router.visit(props.navLink.url, { method: props.navLink.type || HttpMethodEnum.GET })
  isMenuOpen.value = false
}
</script>

<template>
  <div class="cursor-pointer py-1" @click="navigateToPage">
    {{ navLink.name }}
  </div>
</template>
