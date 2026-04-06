<script setup lang="ts">
import { NavigationMenuList } from '@/components/ui/navigation-menu'
import type { NavLink, NavLinkMenu } from '@/types/portfolio'
import { isNavLink } from '@/lib/utils'
import NavMenuDropdown from './NavMenuDropdown.vue';
import NavMenuLink from './NavMenuLink.vue';

defineProps<{ navLinks: Array<NavLink | NavLinkMenu> }>()
</script>

<template>
  <NavigationMenuList>
    <template
      v-for="navLink in navLinks">
      <NavMenuLink
        v-if="isNavLink(navLink)" :navLink="navLink" />
      <NavMenuDropdown
        v-else :navLinkMenu="navLink" />
    </template>
  </NavigationMenuList>
</template>
