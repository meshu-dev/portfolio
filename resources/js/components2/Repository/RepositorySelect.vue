<script setup lang="ts">
import {
  Select,
  SelectContent,
  SelectItem,
  SelectTrigger,
  SelectValue,
} from '@/components/ui/select'

const props = defineProps({ repositories: Object })
const selectedRepositories = defineModel()
</script>

<template>
    <Select name="technologies" multiple v-model:modelValue="selectedRepositories">
        <SelectTrigger class="w-xl">
            <SelectValue placeholder="Select technology" />
        </SelectTrigger>
        <SelectContent>
            <SelectItem  v-for="repository in repositories" :value="repository.id" selected>
                {{ repository.name }}
            </SelectItem>
        </SelectContent>
    </Select>
</template>
