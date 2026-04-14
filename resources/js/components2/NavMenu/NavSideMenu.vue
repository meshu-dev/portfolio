<script setup lang="ts">
import { NavLink, NavLinkMenu } from '@/types/portfolio'
import { isNavLink } from '@/lib/utils'
import { Link, router } from '@inertiajs/vue3'
import NavCollapsibleLink from './NavCollapsibleLink.vue'
import NavSideMenuLink from './NavSideMenuLink.vue';

defineProps<{ navLinks: Array<NavLink | NavLinkMenu> }>()
const isMenuOpen = defineModel('isMenuOpen')
</script>

<template>
  <template
    v-for="navLink in navLinks">
    <NavSideMenuLink
      v-if="isNavLink(navLink)"
      :navLink="navLink"
      v-model:is-menu-open="isMenuOpen" />
    <NavCollapsibleLink
      v-else
      :navLinkMenu="navLink"
      v-model:is-menu-open="isMenuOpen" />
  </template>
</template>
