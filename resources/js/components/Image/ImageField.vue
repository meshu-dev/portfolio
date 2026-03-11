<script setup lang="ts">
import Input from '@/components/ui/input/Input.vue'
import { Progress } from '@/components/ui/progress'

const image = defineModel('image')
const progress = defineModel('progress')
</script>

<template>
    <Input
        type="file"
        name="image"
        @input="image = $event.target.files[0]"
        autoComplete="off" />
    <Progress
        v-if="progress"
        :model-value="progress.percentage" />
</template>
