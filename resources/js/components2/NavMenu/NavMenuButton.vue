<script setup lang="ts">
import { ref } from 'vue'
import { Button } from '@/components/ui/button'
import { Sheet, SheetContent, SheetHeader, SheetTrigger } from '@/components/ui/sheet'
import { Menu, ChevronDown, ChevronRight } from 'lucide-vue-next'
import { NavLink, NavLinkMenu } from '@/types/portfolio'
import NavSideMenu from './NavSideMenu.vue'

const isOpen = ref(false)

defineProps<{ navLinks: Array<NavLink | NavLinkMenu> }>()
</script>

<template>
  <div>
    <Sheet v-model:open="isOpen">
      <SheetTrigger as-child>
        <Button variant="outline" size="icon" class="cursor-pointer">
          <Menu className="h-5 w-5" />
        </Button>
      </SheetTrigger>
      <SheetContent>
        <SheetHeader />
        <div class="grid flex-1 auto-rows-min gap-6 pt-10 px-4">
          <NavSideMenu v-model:isMenuOpen="isOpen" :navLinks="navLinks" />
        </div>
      </SheetContent>
    </Sheet>
  </div>
</template>
