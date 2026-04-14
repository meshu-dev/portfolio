<script setup lang="ts">
import {
  Dialog,
  DialogContent,
  DialogHeader,
  DialogTitle,
} from '@/components/ui/dialog'
import Button from '@/components/ui/button/Button.vue'

const props = defineProps({ title: String, message: String })

const deleteDialogOpen = defineModel()

const emit = defineEmits(['confirmDelete'])
</script>

<template>
  <Dialog v-model:open="deleteDialogOpen">
    <DialogContent>
      <DialogHeader>
        <DialogTitle>{{ title }}</DialogTitle>
      </DialogHeader>
      <div class="gap-3">
        {{ message }}
      </div>
      <div class="flex justify-center gap-2">
        <Button
          class="btn-primary cursor-pointer"
          @click="emit('confirmDelete')">
          Yes
        </Button>
        <Button
          class="btn-primary cursor-pointer"
          @click="deleteDialogOpen = false">
          No
        </Button>
      </div>
    </DialogContent>
  </Dialog>
</template>
