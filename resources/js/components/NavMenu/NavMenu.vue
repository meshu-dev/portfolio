<script setup lang="ts">
import { NavigationMenu, NavigationMenuList } from '@/components/ui/navigation-menu'
import type { NavLink, NavLinkMenu } from '@/types/portfolio'
import NavMenuButton from '@/components/NavMenu/NavMenuButton.vue'
import NavMenuLinks from './NavMenuLinks.vue'

defineProps({ navLinks: Array<NavLink | NavLinkMenu> })
</script>

<template>
  <NavigationMenu
    v-if="navLinks"
    :viewport="false"
    class="user-menu my-4"
    :orientation="'vertical'">
      <NavMenuLinks :navLinks="navLinks" />
  </NavigationMenu>
  <NavMenuButton
    v-if="navLinks"
    :navLinks="navLinks" />
</template>
