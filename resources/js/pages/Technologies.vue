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
import { router } from '@inertiajs/vue3'
import Button from '@/components/ui/button/Button.vue'
import DeleteDialog from '@/components/DeleteDialog.vue'
import { Technology } from '@/types/portfolio'
import PageHeader from '@/components/PageHeader.vue'
import AddTechnologyDialog from '@/components/Technology/AddTechnologyDialog.vue'

const props = defineProps({ technologies: Array<Technology> })

const addDialogOpen: Ref<boolean> = ref(false)

const deleteDialogOpen: Ref<boolean> = ref(false)
const deleteName: Ref<string> = ref('')
const deleteId: Ref<string> = ref('')

const deleteTechnologyDialog = (id: string, name: string) => {
  deleteDialogOpen.value = true
  deleteId.value = id
  deleteName.value = name
}

const deleteTechnology = () => {
  deleteDialogOpen.value = false
  router.delete(`/technologies/${deleteId.value}`)
}
</script>

<template>
  <PageHeader value="Technologies" />
  <Button class="btn-primary cursor-pointer" @click="addDialogOpen = true">Add</Button>
  <div v-if="technologies && technologies.length > 0" class="mt-4 min-h-[650px]">
    <Table>
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
              @click="deleteTechnologyDialog(technology.id, technology.name)">
              Delete
            </Button>
          </TableCell>
        </TableRow>
      </TableBody>
    </Table>
  </div>
  <AddTechnologyDialog v-model="addDialogOpen" />
  <DeleteDialog
    :title="`Delete ${deleteName}`"
    :message="`Are you sure you want to delete ${deleteName}?`"
    v-model="deleteDialogOpen"
    @confirm-delete="deleteTechnology" />
</template>