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
import { toRaw } from 'vue'
import { Repository } from '@/types/portfolio'
import PageHeader from '@/components/PageHeader.vue'
import AddRepositoryDialog from '@/components/Repository/AddRepositoryDialog.vue'

const props = defineProps({ repositories: Array<Repository> })

const addDialogOpen: Ref<boolean> = ref(false)

const deleteDialogOpen: Ref<boolean> = ref(false)
const deleteName: Ref<string> = ref('')
const deleteId: Ref<string> = ref('')

const deleteRepositoryDialog = (id: string, name: string) => {
  deleteDialogOpen.value = true
  deleteId.value = id
  deleteName.value = name
}

const deleteRepository = () => {
  deleteDialogOpen.value = false
  router.delete(`/repositories/${deleteId.value}`)
}
</script>

<template>
  <PageHeader value="Repositories" />
  <Button class="btn-primary cursor-pointer" @click="addDialogOpen = true">Add</Button>
  <div v-if="repositories && repositories.length > 0" class="min-h-[650px]">
    <Table class="table-fixed">
      <TableHeader>
        <TableRow class="text-xl font-extrabold">
          <TableHead>Name</TableHead>
          <TableHead class="w-md">Url</TableHead>
          <TableHead>Action</TableHead>
        </TableRow>
      </TableHeader>
      <TableBody>
        <TableRow v-for="repository in repositories" class="">
          <TableCell>{{ repository.name }}</TableCell>
          <TableCell>{{ repository.url }}</TableCell>
          <TableCell>
            <Button
              class="btn-primary cursor-pointer"
              @click="deleteRepositoryDialog(repository.id, repository.name)">
              Delete
            </Button>
          </TableCell>
        </TableRow>
      </TableBody>
    </Table>
  </div>
  <AddRepositoryDialog v-model="addDialogOpen" />
  <DeleteDialog
    :title="`Delete ${deleteName}`"
    :message="`Are you sure you want to delete ${deleteName}?`"
    v-model="deleteDialogOpen"
    @confirm-delete="deleteRepository" />
</template>