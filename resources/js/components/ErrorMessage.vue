<script setup lang="ts">
import { AlertCircleIcon } from 'lucide-vue-next'

defineProps({ value: String })
</script>

<template>
  <div class="error-message">
    <AlertCircleIcon class="w-[1rem]" />
    <span>{{ value }}</span>
  </div>
</template>
