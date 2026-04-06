<script setup lang="ts">
import Button from '@/components/ui/button/Button.vue'
import PageHeader from '@/components/PageHeader.vue'
import { ProjectListItem } from '@/types/portfolio'
import {
  Table,
  TableBody,
  TableCell,
  TableHead,
  TableHeader,
  TableRow,
} from '@/components/ui/table'
import { ref, Ref } from 'vue'
import { router } from '@inertiajs/vue3'
import { Link } from '@inertiajs/vue3'
import DeleteDialog from '@/components/DeleteDialog.vue'

const props = defineProps({ projects: Array<ProjectListItem> })

console.log('Blah!', props.projects)

const addDialogOpen: Ref<boolean> = ref(false)

const deleteDialogOpen: Ref<boolean> = ref(false)
const deleteName: Ref<string> = ref('')
const deleteId: Ref<string> = ref('')

const deleteDialog = (id: string, name: string) => {
  deleteDialogOpen.value = true
  deleteId.value = id
  deleteName.value = name
}

const deleteProject = () => {
  deleteDialogOpen.value = false
  router.delete(`/technologies/${deleteId.value}`)
}
</script>

<template>
  <PageHeader value="Projects" />
  <Link href="/portfolio/projects/new">
    <Button class="btn-primary cursor-pointer">Add</Button>
  </Link>
  <div v-if="projects && projects.length > 0" class="mt-4 min-h-[650px]">
    <Table class="table-fixed">
      <TableHeader>
        <TableRow class="text-xl font-extrabold">
          <TableHead>Name</TableHead>
          <TableHead>Url</TableHead>
          <TableHead>Action</TableHead>
        </TableRow>
      </TableHeader>
      <TableBody>
        <TableRow v-for="project in projects">
          <TableCell>
            <Link :href="`/portfolio/projects/${project.id}`">{{ project.name }}</Link>
          </TableCell>
          <TableCell>{{ project.url }}</TableCell>
          <TableCell>
            <Button
              class="btn-primary cursor-pointer"
              @click="deleteDialog(project.id, project.name)">
              Delete
            </Button>
          </TableCell>
        </TableRow>
      </TableBody>
    </Table>
  </div>
  <DeleteDialog
    :title="`Delete ${deleteName}`"
    :message="`Are you sure you want to delete ${deleteName}?`"
    v-model="deleteDialogOpen"
    @confirm-delete="deleteProject" />
</template>
