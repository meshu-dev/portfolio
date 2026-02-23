<script setup lang="ts">
import { ref } from 'vue'
import { type Ref } from 'vue'
import {
  Table,
  TableBody,
  TableCell,
  TableHead,
  TableHeader,
  TableRow,
} from '@/components/ui/table'
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
import { toRaw } from 'vue'

const props = defineProps({ technologies: Object })

const technologyName: Ref<string> = ref('')
const deleteDialogOpen: Ref<boolean> = ref(false)

const addTechnology = (name: string) => {
  router.post(`/technologies`, { name: technologyName.value })
}

const deleteTechnology = (id: string) => {
  router.delete(`/technologies/${id}`)
}
</script>

<template>
  <h1>Technologies</h1>
  <Button class="btn-primary cursor-pointer" @click="deleteDialogOpen = true">Add</Button>
  <template v-if="technologies.length > 0">
    <div class="min-h-[650px]">
      <Table class="table-fixed">
        <TableHeader>
          <TableRow class="text-xl font-extrabold">
            <TableHead class="w-lg">Name</TableHead>
            <TableHead>Action</TableHead>
          </TableRow>
        </TableHeader>
        <TableBody>
          <TableRow v-for="technology in technologies">
            <TableCell>{{ technology.name }}</TableCell>
            <TableCell>
              <Button
                class="btn-primary cursor-pointer"
                @click="deleteTechnology(technology.id)">
                Delete
              </Button>
            </TableCell>
          </TableRow>
        </TableBody>
      </Table>
    </div>
  </template>
  <Dialog v-model:open="deleteDialogOpen">
    <DialogContent>
      <DialogHeader>
        <DialogTitle>Add Technology</DialogTitle>
      </DialogHeader>
      <Form action="/technologies" method="post" class="grid gap-4" @success="deleteDialogOpen = false">
        <div class="grid gap-3">
          <Label for="newTechnology">Name</Label>
          <Input id="newTechnology" name="name" />
        </div>
        <div>
          <Button class="btn-primary cursor-pointer" @click="addTechnology">
            Add
          </Button>
        </div>
      </Form>
    </DialogContent>
  </Dialog>
</template>