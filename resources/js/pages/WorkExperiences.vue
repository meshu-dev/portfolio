<script setup lang="ts">
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

const props = defineProps({ workExperiences: Object })

const deleteWorkExperience = (id: string) => {
  router.delete(`/work-experiences/${id}`)
}

</script>

<template>
  <h1>Work Experiences</h1>
  <Button class="btn-primary cursor-pointer">Add</Button>
  <template v-if="workExperiences">
    <div class="min-h-[650px]">
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
              <Link :href="'/work-experiences/' + workExperience.id">
                {{ workExperience.title }}
              </Link>
            </TableCell>
            <TableCell>{{ workExperience.company }}</TableCell>
            <TableCell>
              <Button class="btn-primary cursor-pointer" @click="deleteWorkExperience(workExperience.id)">
                Delete
              </Button>
            </TableCell>
          </TableRow>
        </TableBody>
      </Table>
    </div>
  </template>
</template>