<script setup lang="ts">
import { Button } from '@/components/ui/button'
import { Input } from '@/components/ui/input'
import { Label } from '@/components/ui/label'
import { Sheet, SheetContent, SheetHeader, SheetTrigger } from '@/components/ui/sheet'
import { Menu } from 'lucide-vue-next'
import NavMenu from './NavMenu.vue'
import { NavLink, NavLinkMenu } from '@/types/portfolio'
import NavigationMenu from '../ui/navigation-menu/NavigationMenu.vue'
import NavMenuLinks from './NavMenuLinks.vue'

defineProps<{ navLinks: Array<NavLink | NavLinkMenu> }>()
</script>

<template>
  <Sheet>
    <SheetTrigger as-child>
      <Button variant="outline" size="icon" class="cursor-pointer">
        <Menu className="h-5 w-5" />
        <span className="sr-only">Toggle menu</span>
      </Button>
    </SheetTrigger>
    <SheetContent>
      <SheetHeader />
      <div class="grid flex-1 auto-rows-min gap-6 px-4">
        <div class="grid gap-3">
          <Label for="sheet-demo-username">Username</Label>
          <Input id="sheet-demo-username" default-value="@peduarte" />
        </div>
        <NavigationMenu
          v-if="navLinks"
          :viewport="false"
          class="user-menu my-4"
          :orientation="'vertical'">
            <NavMenuLinks :navLinks="navLinks" />
        </NavigationMenu>
      </div>
    </SheetContent>
  </Sheet>
</template>
