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
const url: Ref<string> = ref('')

const create = () => {
  router.post(`/portfolio/repositories`, { name: name.value })
}
</script>

<template>
  <Dialog v-model:open="addDialogOpen">
    <DialogContent>
      <DialogHeader>
        <DialogTitle>Add Repository</DialogTitle>
      </DialogHeader>
      <Form method="post" class="grid gap-4" @success="addDialogOpen = false">
        <div class="grid gap-3">
          <Label for="name">Name</Label>
          <Input id="name" name="name" />
        </div>
        <div class="grid gap-3">
          <Label for="url">Url</Label>
          <Input id="url" name="url" />
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
