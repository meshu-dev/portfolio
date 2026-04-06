<script setup lang="ts">
import { NavigationMenu, NavigationMenuList } from '@/components/ui/navigation-menu'
import type { NavLink, NavLinkMenu } from '@/types/portfolio'
import NavMenuLink from './NavMenuLink.vue'
import NavMenuDropdown from './NavMenuDropdown.vue'

defineProps({ navLinks: Array<NavLink|NavLinkMenu> })

const isNavLink = (navLink: NavLink | NavLinkMenu): navLink is NavLink => {
  return (navLink as NavLink).url !== undefined
}
</script>

<template>
  <NavigationMenu :viewport="false" class="user-menu my-4">
    <NavigationMenuList>
      <template
        v-for="navLink in navLinks">
        <NavMenuLink
          v-if="isNavLink(navLink)" :navLink="navLink" />
        <NavMenuDropdown
          v-else :navLinkMenu="navLink" />
      </template>
    </NavigationMenuList>
  </NavigationMenu>
</template>
