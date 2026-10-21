<script setup lang="ts">
  import GitRepoButton from '@/components/GitRepoButton.vue'

  const projects = getProjects()
  console.log('projects', projects)
</script>

<template>
  <div>
    <PageTitle title="Projects" />
    <ul class="border-t border-default">
      <li
        v-for="project of projects"
        :key="project.name"
        class="grid gap-6 border-b border-default py-10 md:grid-cols-12 md:gap-10">
        <img
          :src="project.image_url"
          :alt="project.name"
          class="aspect-[16/10] w-full rounded-sm object-cover md:col-span-5" />
        <div class="flex flex-col md:col-span-7">
          <h2 class="text-3xl sm:text-4xl font-extrabold tracking-tight text-highlighted">{{ project.name }}</h2>
          <p class="mt-3 max-w-[52ch] font-serif text-xl text-toned">{{ project.description }}</p>
          <p class="mt-4 text-muted">{{ project.technologies.join(', ') }}</p>
          <div class="mt-auto flex flex-wrap gap-3 pt-8">
            <UButton :to="project.url" target="_blank">View</UButton>
            <GitRepoButton :repositories="project.repositories">View</GitRepoButton>
          </div>
        </div>
      </li>
    </ul>
  </div>
</template>
