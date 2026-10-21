<script setup lang="ts">
import type { NavigationMenuItem } from '@nuxt/ui'
import Logo from '~/components/Logo.vue'

const route = useRoute()

const menuItems = computed<NavigationMenuItem[]>(() => [
  {
    label: 'Home',
    to: '/',
    active: route.path === '/'
  },
  {
    label: 'About',
    to: '/about',
    active: route.path.startsWith('/about')
  },
  {
    label: 'Projects',
    to: '/projects',
    active: route.path.startsWith('/projects')
  },
  {
    label: 'Contact',
    to: '/contact',
    active: route.path.startsWith('/contact')
  },
])

const intro = getIntro()

const siteItems: NavigationMenuItem[] = []

if (intro?.sites) {
  for (const site of intro?.sites) {
    siteItems.push({
      label: site.name,
      icon: site.icon,
      to: site.url,
      target: '_blank'
    })
  }
}

const mobileSiteItems = computed<NavigationMenuItem[]>(() => siteItems)
</script>

<template>
  <div>
    <UHeader :ui="{ root: 'bg-default/90 backdrop-blur border-b border-default', title: 'font-extrabold text-xl tracking-tight' }">
      <template #title>
        <Logo class="h-6 w-auto" />
      </template>
      
      <UNavigationMenu :items="menuItems" variant="link" highlight class="font-medium" />

      <template #body>
        <UNavigationMenu orientation="vertical" :items="menuItems" />
        <div class="block md:hidden">
          <USeparator class="my-4" />
          <UNavigationMenu orientation="vertical" :items="mobileSiteItems" />
        </div>
      </template>

      <template #right>
        <UButton
          v-for="site of intro?.sites"
          :key="site.name"
          color="neutral"
          variant="ghost"
          :to="site.url"
          target="_blank"
          :icon="site.icon"
          :aria-label="site.name"
          class="hidden md:flex"
        />
        <UColorModeButton class="hover:cursor-pointer" />
      </template>
    </UHeader>
    <UContainer class="min-h-[610px] py-12 sm:py-20">
      <slot />
    </UContainer>
    <USeparator />
    <UFooter>
      <template #left>
        <p class="text-muted text-sm">
          Built with 
          <a href="https://laravel.com" class="font-semibold text-highlighted hover:underline underline-offset-4" target="_blank">Laravel</a> &amp;
          <a href="https://nuxt.com" class="font-semibold text-highlighted hover:underline underline-offset-4" target="_blank">Nuxt.js</a>
        </p>
      </template>
      <template #right>
        <p class="text-muted text-sm">
          Copyright &copy; {{ new Date().getFullYear() }} Mesh Pro. All rights reserved
        </p>
      </template>
    </UFooter>
  </div>
</template>
