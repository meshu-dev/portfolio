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
import { Site } from '@/types/portfolio'
import PageHeader from '@/components/PageHeader.vue'
import { Link } from '@inertiajs/vue3'

const props = defineProps({ sites: Array<Site> })

const deleteDialogOpen: Ref<boolean> = ref(false)
const deleteName: Ref<string> = ref('')
const deleteId: Ref<string> = ref('')

const deleteSiteDialog = (id: string, name: string) => {
  deleteDialogOpen.value = true
  deleteId.value = id
  deleteName.value = name
}

const deleteSite = () => {
  deleteDialogOpen.value = false
  router.delete(`/sites/${deleteId.value}`)
}
</script>

<template>
  <PageHeader value="Sites" />
  <Link href="/sites/new">
    <Button class="btn-primary cursor-pointer">Add</Button>
  </Link>
  <div v-if="sites && sites.length > 0" class="min-h-[650px]">
    <Table class="table-fixed">
      <TableHeader>
        <TableRow class="text-xl font-extrabold">
          <TableHead>Name</TableHead>
          <TableHead class="w-md">Url</TableHead>
          <TableHead>Action</TableHead>
        </TableRow>
      </TableHeader>
      <TableBody>
        <TableRow v-for="site in sites">
          <TableCell>
            <Link :href="`/sites/${site.id}`">{{ site.name }}</Link>
          </TableCell>
          <TableCell>{{ site.url }}</TableCell>
          <TableCell>
            <Button
              class="btn-primary cursor-pointer"
              @click="deleteSiteDialog(site.id, site.name)">
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
    @confirm-delete="deleteSite" />
</template>