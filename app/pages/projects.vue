<script setup lang="ts">
  import GitRepoButton from '@/components/GitRepoButton.vue'

  const projects = getProjects()
  console.log('projects', projects)
</script>

<template>
  <div class="flex justify-center">
    <div>
      <UPageHeader title="My Portfolio" class="mb-6" />
      <div class="grid grid-cols-1 sm:grid-cols-2 gap-10">
        <UCard
          v-for="project of projects"
          class="w-full lg:w-120 p-0">
            <div class="grid justify-items-stretch">
              <img :src="project.image_url" :alt="project.name" class="h-fit sm:h-80 lg:h-100 object-fill" />
              <div class="p-4">
                <div class="font-semibold text-2xl">{{ project.name }}</div>
                <div class="w-full mt-4 flex flex-col gap-4 md:justify-between lg:flex-row lg:gap-8">
                  <div class="flex gap-3">
                    <UButton :to="project.url" target="_blank">View</UButton>
                    <GitRepoButton :repositories="project.repositories">View</GitRepoButton>
                  </div>
                  <div class="flex gap-3">
                    <UBadge
                      v-for="technology of project.technologies"
                      class="text-xl font-normal px-2"
                      color="neutral"
                      variant="outline">
                      {{ technology }}
                    </UBadge>
                  </div>
                </div>
              </div>
            </div>
        </UCard>
      </div>
    </div>
  </div>
</template>
