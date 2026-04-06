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
  <!-- 
  <Collapsible
    v-model:open="isOpen"
    class="flex w-[350px] flex-col gap-2"
  >
    <div class="flex items-center justify-between gap-4 px-4">
      <h4 class="text-sm font-semibold">
        @peduarte starred 3 repositories
      </h4>
      <CollapsibleTrigger as-child>
        <Button variant="ghost" size="icon" class="size-8">
          <ChevronsUpDown />
          <span class="sr-only">Toggle</span>
        </Button>
      </CollapsibleTrigger>
    </div>
    <div class="rounded-md border px-4 py-2 font-mono text-sm">
      @radix-ui/primitives
    </div>
    <CollapsibleContent class="flex flex-col gap-2">
      <div class="rounded-md border px-4 py-2 font-mono text-sm">
        @radix-ui/colors
      </div>
      <div class="rounded-md border px-4 py-2 font-mono text-sm">
        @stitches/react
      </div>
    </CollapsibleContent>
  </Collapsible> -->
</template>
