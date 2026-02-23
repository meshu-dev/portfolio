<script setup lang="ts">
import { ref, type Ref } from 'vue'
import { router } from '@inertiajs/vue3'
import {
  Table,
  TableBody,
  TableCell,
  TableHead,
  TableHeader,
  TableRow,
} from '@/components/ui/table'
import { Link } from '@inertiajs/vue3'
import Button from '@/components/ui/button/Button.vue'
import { WorkExperience } from '@/types/portfolio'
import DeleteDialog from '@/components/DeleteDialog.vue'

const props = defineProps({ workExperiences: Object })

const deleteDialogOpen: Ref<boolean> = ref(false)
const deleteDialogTitle: Ref<string> = ref('')
const deleteDialogMessage: Ref<string> = ref('')
const deleteId: Ref<string> = ref('')

const deleteTechnologyDialog = (id: string) => {
  if (!props.workExperiences) return

  const filteredWorkExperiences: WorkExperience[] = props.workExperiences.filter((workExperience: WorkExperience) => workExperience.id == id)
  const deleteWorkExperience: WorkExperience = filteredWorkExperiences[0]

  deleteDialogTitle.value = `Delete ${deleteWorkExperience.title}`
  deleteDialogMessage.value = `Are you sure you want to delete ${deleteWorkExperience.title}?`
  deleteDialogOpen.value = true

  deleteId.value = id
}

const deleteWorkExperience = () => {
  deleteDialogOpen.value = false
  router.delete(`/work-experiences/${deleteId.value}`)
}
</script>

<template>
  <h1>Work Experiences</h1>
  <Link href="/work-experiences/new">
    <Button class="btn-primary cursor-pointer">Add</Button>
  </Link>
  <div v-if="workExperiences" class="min-h-[650px]">
    <Table class="table-fixed">
      <TableHeader>
        <TableRow class="text-xl font-extrabold">
          <TableHead>Name</TableHead>
          <TableHead>Company</TableHead>
          <TableHead>Action</TableHead>
        </TableRow>
      </TableHeader>
      <TableBody>
        <TableRow v-for="workExperience in workExperiences">
          <TableCell>
            <Link :href="`/work-experiences/${workExperience.id}`">
              {{ workExperience.title }}
            </Link>
          </TableCell>
          <TableCell>{{ workExperience.company }}</TableCell>
          <TableCell>
            <Button
              class="btn-primary cursor-pointer"
              @click="deleteTechnologyDialog(workExperience.id)">
              Delete
            </Button>
          </TableCell>
        </TableRow>
      </TableBody>
    </Table>
  </div>
  <DeleteDialog
    :title="deleteDialogTitle"
    :message="deleteDialogMessage"
    v-model="deleteDialogOpen"
    @confirm-delete="deleteWorkExperience" />
</template>