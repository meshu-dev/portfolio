<script setup lang="ts">
import { ref } from 'vue'
import { Link } from '@inertiajs/vue3'
import type { NavLinkMenu } from '@/types/portfolio'
import {
  Collapsible,
  CollapsibleContent,
  CollapsibleTrigger,
} from '@/components/ui/collapsible'
import { ChevronDown, ChevronUp } from 'lucide-vue-next'
import Button from '../ui/button/Button.vue'
import NavSideMenuLink from './NavSideMenuLink.vue'

defineProps<{ navLinkMenu: NavLinkMenu }>()
const isMenuOpen = defineModel('isMenuOpen')

const isOpen = ref(false)
</script>

<template>
  <Collapsible
    v-model:open="isOpen"
    class="flex w-[350px] flex-col gap-2">
    <div class="items-center justify-between gap-4 w-full">
      <CollapsibleTrigger as-child>
        <div class="flex justify-between cursor-pointer py-1">
          <span class="text-left">{{ navLinkMenu.name }}</span>
          <ChevronUp
            v-if="isOpen" />
          <ChevronDown
            v-else />
        </div>
      </CollapsibleTrigger>
    </div>
    <CollapsibleContent class="flex flex-col gap-2 flex-1 auto-rows-min gap-6">
      <NavSideMenuLink
        v-for="navLink in navLinkMenu.links"
        :navLink="navLink"
        v-model:is-menu-open="isMenuOpen"
        class="pl-10" />
    </CollapsibleContent>
  </Collapsible>
</template>
