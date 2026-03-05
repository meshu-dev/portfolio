<script setup lang="ts">
import { ref, type Ref } from 'vue'
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

const addDialogOpen = defineModel()
const name: Ref<string> = ref('')

const create = () => {
  router.post(`/technologies`, { name: name.value })
}
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
          <Input id="newTechnology" name="name" />
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