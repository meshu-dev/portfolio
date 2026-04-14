<script setup lang="ts">
import { onUnmounted, ref, type Ref } from 'vue'
import type { Errors } from '@inertiajs/core'
import {
  Dialog,
  DialogContent,
  DialogHeader,
  DialogTitle,
} from '@/components/ui/dialog'
import { Form } from '@inertiajs/vue3'
import { router } from '@inertiajs/vue3'
import Label from '@/components/ui/label/Label.vue'
import Input from '@/components/ui/input/Input.vue'
import Button from '@/components/ui/button/Button.vue'
import ErrorMessage from '@/components/ErrorMessage.vue'

const addDialogOpen = defineModel()
const name: Ref<string> = ref('')
const errors: Ref<Errors|null> = ref(null)

const create = () => {
  router.post(`/technologies`, { name: name.value })
}

onUnmounted(
  router.on('error', (event) => {
    errors.value = event.detail.errors
  })
)
</script>

<template>
  <Dialog v-model:open="addDialogOpen">
    <DialogContent>
      <DialogHeader>
        <DialogTitle>Add Technology</DialogTitle>
      </DialogHeader>
      <Form method="post" class="grid gap-4" @success="addDialogOpen = false">
        <div class="grid gap-3">
          <Label for="newTechnology">Name</Label>
          <Input id="newTechnology" name="name" :class="errors?.name ? `error-field` : ``" />
          <ErrorMessage v-if="errors?.name" :value="errors?.name" />
        </div>
        <div>
          <Button class="btn-primary cursor-pointer" @click="create">
            Add
          </Button>
        </div>
      </Form>
    </DialogContent>
  </Dialog>
</template>