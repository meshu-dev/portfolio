<script setup lang="ts">
import { ref, type Ref } from 'vue'
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
import DeleteDialog from '@/components/DeleteDialog.vue'
import { toRaw } from 'vue'
import { Technology } from '@/types/portfolio'
import PageHeader from '@/components/PageHeader.vue'

const props = defineProps({ technologies: Array<Technology> })

const technologyName: Ref<string> = ref('')
const addDialogOpen: Ref<boolean> = ref(false)

const deleteDialogOpen: Ref<boolean> = ref(false)
const deleteDialogTitle: Ref<string> = ref('')
const deleteDialogMessage: Ref<string> = ref('')
const deleteId: Ref<string> = ref('')

const addTechnology = () => {
  router.post(`/technologies`, { name: technologyName.value })
}

const deleteTechnologyDialog = (id: string) => {
  if (!props.technologies) return

  const filteredTechnologies: Technology[] = props.technologies.filter((technology: Technology) => technology.id == id)
  const deleteTechnology: Technology = filteredTechnologies[0]

  deleteDialogTitle.value = `Delete ${deleteTechnology.name}`
  deleteDialogMessage.value = `Are you sure you want to delete ${deleteTechnology.name}?`
  deleteDialogOpen.value = true

  deleteId.value = id
}

const deleteTechnology = () => {
  deleteDialogOpen.value = false
  router.delete(`/technologies/${deleteId.value}`)
}
</script>

<template>
  <PageHeader value="Technologies" />
  <Button class="btn-primary cursor-pointer" @click="addDialogOpen = true">Add</Button>
  <div v-if="technologies && technologies.length > 0" class="min-h-[650px]">
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
              @click="deleteTechnologyDialog(technology.id)">
              Delete
            </Button>
          </TableCell>
        </TableRow>
      </TableBody>
    </Table>
  </div>
  <Dialog v-model:open="addDialogOpen">
    <DialogContent>
      <DialogHeader>
        <DialogTitle>Add Technology</DialogTitle>
      </DialogHeader>
      <Form action="/technologies" method="post" class="grid gap-4" @success="addDialogOpen = false">
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
  <DeleteDialog
    :title="deleteDialogTitle"
    :message="deleteDialogMessage"
    v-model="deleteDialogOpen"
    @confirm-delete="deleteTechnology" />
</template>