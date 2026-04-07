<script setup lang="ts">
import Button from '@/components/ui/button/Button.vue'

const imageUrl = defineModel()

const removeImage = (): void => {
  imageUrl.value = ''
}
</script>

<template>
    <div class="flex flex-col xs:flex-row mt-4 gap-4">
        <img :src="imageUrl" class="w-full m-auto shadow-md xs:max-w-xs xs:m-0" />
        <Button size="sm" class="cursor-pointer" @click="removeImage">Remove</Button>
    </div>
</template>
