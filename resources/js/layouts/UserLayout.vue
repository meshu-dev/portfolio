<script setup lang="ts">
import { Head } from '@inertiajs/vue3'
import 'vue-sonner/style.css'
import { Toaster } from '@/components/ui/sonner'
import { toast } from 'vue-sonner'
import { router } from '@inertiajs/vue3'
import { onUnmounted } from 'vue'
import Logo from '@/components/Logo.vue'
import NavMenu from '@/components/NavMenu.vue'
import NavMenuButton from '@/components/NavMenuButton.vue'
import { NavLink, NavLinkMenu } from '@/types/portfolio'

const navLinks: Array<NavLink|NavLinkMenu> = [
  {
    name: 'CV',
    links: [
      { name: 'Profile', url: '/' },
      { name: 'Skills', url: '/cv/skills' },
      { name: 'Work Experiences', url: '/cv/work-experiences' },
      { name: 'PDF', url: '/cv/pdf' },
    ],
  },
  {
    name: 'Portfolio',
    links: [
      { name: 'Intro', url: '/portfolio/intro' },
      { name: 'About', url: '/portfolio/about' },
      { name: 'Repositories', url: '/portfolio/repositories' },
      { name: 'Projects', url: '/portfolio/projects' },
    ],
  },
  { name: 'Technologies', url: '/technologies' },
  { name: 'Sites', url: '/sites' },
  { name: 'Logout', url: '/logout' }
]

onUnmounted(
  router.on('flash', (event) => {
      if (event.detail.flash['message']) {
        toast(event.detail.flash['message'])
      }
  })
)
</script>

<template>
  <Head title="Portfolio Admin">
    <meta name="description" content="Your page description">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  </Head>
  <div class="user-layout">
    <header>
      <Logo />
      <NavMenu :navLinks="navLinks" />
      <NavMenuButton />
    </header>
    <main>
      <slot />
    </main>
  </div>
  <Toaster position="top-center"
  />
</template>
