<script setup lang="ts">
import Button from '@/components/ui/button/Button.vue'

const imageUrl = defineModel()

const removeImage = (): void => {
  imageUrl.value = ''
}
</script>

<template>
    <div class="flex mt-4 gap-4">
        <img :src="imageUrl" class="max-w-xs shadow-md" />
        <Button size="sm" class="cursor-pointer"  @click="removeImage">Remove</Button>
    </div>
</template>
