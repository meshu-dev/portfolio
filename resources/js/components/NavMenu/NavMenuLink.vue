<script setup lang="ts">
import { Link } from '@inertiajs/vue3'
import { NavigationMenuItem, NavigationMenuLink } from '@/components/ui/navigation-menu'
import type { NavLink } from '@/types/portfolio'
import { HttpMethodEnum } from '@/enums/HttpMethodEnum'

defineProps<{ navLink: NavLink }>()
</script>

<template>
  <NavigationMenuItem class="px-2">
    <NavigationMenuLink class="cursor-pointer">
      <Link :href="navLink.url" :method="navLink.type || HttpMethodEnum.GET">{{ navLink.name }}</Link>
    </NavigationMenuLink>
  </NavigationMenuItem>
</template>
