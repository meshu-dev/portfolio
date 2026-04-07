<script setup lang="ts">
import { Link } from '@inertiajs/vue3'
import {
  NavigationMenuItem,
  NavigationMenuContent,
  NavigationMenuLink,
  NavigationMenuTrigger,
} from '@/components/ui/navigation-menu'
import type { NavLinkMenu } from '@/types/portfolio'

defineProps<{ navLinkMenu: NavLinkMenu }>()
</script>

<template>
  <NavigationMenuItem>
    <NavigationMenuTrigger class="bg-transparent cursor-pointer">
      {{ navLinkMenu.name }}
    </NavigationMenuTrigger>
    <NavigationMenuContent class="z-1">
      <ul class="grid w-[140px]">
        <li v-for="navLink in navLinkMenu.links">
          <NavigationMenuLink as-child>
            <Link :href="navLink.url">{{ navLink.name }}</Link>
          </NavigationMenuLink>
        </li>
      </ul>
    </NavigationMenuContent>
  </NavigationMenuItem>
</template>
