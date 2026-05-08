<script setup lang="ts">
  import type { DropdownMenuItem } from '@nuxt/ui'
  import type { Repository } from '~/types/Portfolio'

  type Props = {
    repositories: Repository[] | null
  }

  const props = withDefaults(defineProps<Props>(), {
    repositories: null
  })

  const options = ref<DropdownMenuItem[]>([])

  if (props.repositories && props.repositories.length > 1) {
    for (const repository of props.repositories) {
      options.value.push({
        label: repository.name,
        to: repository.url,
        target: '_blank'
      })
    }
  }
</script>

<template>
  <template v-if="options.length > 1">
    <UDropdownMenu :items="options">
      <UButton class="cursor-pointer">Github</UButton>
    </UDropdownMenu>
  </template>
  <template v-else-if="props.repositories?.length == 1">
    <UButton :to="props.repositories[0]?.url" target="_blank">Github</UButton>
  </template>
</template>
