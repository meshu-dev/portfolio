<script setup lang="ts">
import {
  Table,
  TableBody,
  TableCell,
  TableHead,
  TableHeader,
  TableRow,
} from '@/components/ui/table'
import {
  Pagination,
  PaginationContent,
  PaginationItem,
  PaginationNext,
  PaginationPrevious,
} from '@/components/ui/pagination'
import {
  Dialog,
  DialogClose,
  DialogContent,
  DialogDescription,
  DialogFooter,
  DialogHeader,
  DialogTitle,
  DialogTrigger,
} from '@/components/ui/dialog'
import { Link } from '@inertiajs/vue3'
import Label from '@/components/ui/label/Label.vue'
import Input from '@/components/ui/input/Input.vue'
import Button from '@/components/ui/button/Button.vue'
import { toRaw } from 'vue'

const props = defineProps({ technologies: Object })
console.log('BBB', toRaw(props.technologies)) 
</script>

<template>
  <h1>Technologies</h1>
  <Button class="btn-primary cursor-pointer">Add</Button>
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
              <Button class="btn-primary cursor-pointer">
                Delete
              </Button>
            </TableCell>
          </TableRow>
        </TableBody>
      </Table>
    </div>
  </template>
  <Dialog>
    <DialogTrigger>Open</DialogTrigger>
    <DialogContent>
      <DialogHeader>
        <DialogTitle>Add Technology</DialogTitle>
      </DialogHeader>
      <div class="grid gap-4">
        <div class="grid gap-3">
          <Label for="newTechnology">Name</Label>
          <Input id="newTechnology" name="name" />
        </div>
        <div>
          <Button class="btn-primary cursor-pointer">
            Add
          </Button>
        </div>
      </div>
    </DialogContent>
  </Dialog>
</template>