<script setup lang="ts">
import { Form, useForm } from '@inertiajs/vue3'
import { Project } from '@/types/portfolio'
import PageHeader from '@/components/PageHeader.vue'
import { Field } from '@/components/ui/field'
import Label from '@/components/ui/label/Label.vue'
import Input from '@/components/ui/input/Input.vue'
import Button from '@/components/ui/button/Button.vue'

const props = defineProps({ project: Object })
const project: Project|null = props.project ? props.project as Project : null

const form = useForm({
  name: project?.name || '',
  description: project?.description || '',
  url: project?.url || ''
})

const submitForm = (): void => {
  if (project?.id) {
    form.put(`/projects/${project.id}`)
  } else {
    form.post(`/projects`)
  }
  console.log('submitForm')
}
</script>

<template>
  <PageHeader value="Project" />
  <Form v-if="project" :action="`/portfolio/projects/${project.id}`" method="put">
    <Field class="mb-4">
      <Label for="name">Name</Label>
      <Input type="text" name="name" v-model="form.name" autoComplete="off" />
    </Field>
    <Field class="mb-4">
      <Label for="description">Description</Label>
      <Input type="text" name="description" v-model="form.description" autoComplete="off" />
    </Field>
    <Field class="mb-4">
      <Label for="url">Url</Label>
      <Input type="text" name="url" v-model="form.url" autoComplete="off" />
    </Field>
    <Button
      class="cursor-pointer"
      type="submit">
      Save
    </Button>
  </Form>
</template>
