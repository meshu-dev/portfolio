<script setup lang="ts">
import { Form, useForm } from '@inertiajs/vue3'
import { Project } from '@/types/portfolio'
import PageHeader from '@/components/PageHeader.vue'
import { Field } from '@/components/ui/field'
import Label from '@/components/ui/label/Label.vue'
import Input from '@/components/ui/input/Input.vue'
import Button from '@/components/ui/button/Button.vue'

const props = defineProps({ project: Object })

const form = useForm({
  title: props.project?.name || '',
  description: props.project?.description || '',
  url: props.project?.url || ''
})
</script>

<template>
  <PageHeader value="Project" />
  <Form v-if="project" :action="`/projects/${project.id}`" method="put">
    <Field class="mb-4">
      <Label for="intro">Title</Label>
      <Input type="text" name="intro" v-model="form.title" autoComplete="off" />
    </Field>
    <Field class="mb-4">
      <Label for="intro">Description</Label>
      <Input type="text" name="description" v-model="form.description" autoComplete="off" />
    </Field>
    <Field class="mb-4">
      <Label for="intro">Url</Label>
      <Input type="text" name="url" v-model="form.url" autoComplete="off" />
    </Field>
  </Form>
</template>
