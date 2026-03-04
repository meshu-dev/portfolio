<script setup lang="ts">
import {
  NavigationMenu,
  NavigationMenuItem,
  NavigationMenuContent,
  NavigationMenuLink,
  NavigationMenuList,
  NavigationMenuTrigger,
  navigationMenuTriggerStyle,
} from '@/components/ui/navigation-menu'
import { Link } from '@inertiajs/vue3'
</script>

<template>
  <NavigationMenu :viewport="false" class="my-4">
    <NavigationMenuList>
      <NavigationMenuItem>
        <NavigationMenuTrigger>CV</NavigationMenuTrigger>
        <NavigationMenuContent>
          <ul class="grid w-[200px] gap-4">
            <li>
              <NavigationMenuLink as-child>
                <Link href="/">Profile</Link>
              </NavigationMenuLink>
              <NavigationMenuLink as-child>
                <Link href="/skills">Skills</Link>
              </NavigationMenuLink>
              <NavigationMenuLink as-child>
                <Link href="/work-experiences">Work Experiences</Link>
              </NavigationMenuLink>
            </li>
          </ul>
        </NavigationMenuContent>
      </NavigationMenuItem>
      <NavigationMenuItem>
        <NavigationMenuTrigger>Portfolio</NavigationMenuTrigger>
        <NavigationMenuContent>
          <ul class="grid w-[200px] gap-4">
            <li>
              <NavigationMenuLink as-child>
                <Link href="/intro">Intro</Link>
              </NavigationMenuLink>
              <NavigationMenuLink as-child>
                <Link href="/about">About</Link>
              </NavigationMenuLink>
              <NavigationMenuLink as-child>
                <Link href="/projects">Projects</Link>
              </NavigationMenuLink>
            </li>
          </ul>
        </NavigationMenuContent>
      </NavigationMenuItem>
      <NavigationMenuItem>
        <NavigationMenuLink>
          <Link href="/technologies">Technologies</Link>
        </NavigationMenuLink>
      </NavigationMenuItem>
      <NavigationMenuItem>
        <NavigationMenuLink class="cursor-pointer">
          <Link href="/logout" method="post">Logout</Link>
        </NavigationMenuLink>
      </NavigationMenuItem>

    </NavigationMenuList>
  </NavigationMenu>
</template>
