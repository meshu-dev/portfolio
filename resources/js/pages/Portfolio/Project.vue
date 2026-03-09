<script setup lang="ts">
import type { FormDataConvertible } from '@inertiajs/core'
import { Form, useForm } from '@inertiajs/vue3'
import { Project, Repository, Technology } from '@/types/portfolio'
import PageHeader from '@/components/PageHeader.vue'
import { Field } from '@/components/ui/field'
import Label from '@/components/ui/label/Label.vue'
import Input from '@/components/ui/input/Input.vue'
import Button from '@/components/ui/button/Button.vue'
import TechnologySelect from '@/components/Technology/TechnologySelect.vue'
import RepositorySelect from '@/components/Repository/RepositorySelect.vue'

const props = defineProps({ project: Object, repositories: Object, technologies: Object })
const project: Project|null = props.project ? props.project as Project : null

const form = useForm({
  name: project?.name || '',
  description: project?.description || '',
  url: project?.url || '',
  repositories: project.repositories.map((repository: Repository) => repository.id),
  technologies: project.technologies.map((technology: Technology) => technology.id),
})

const submitForm = (): void => {
  if (project?.id) {
    form.put(`/projects/${project.id}`)
  } else {
    form.post(`/projects`)
  }
  console.log('submitForm')
}

const transformData = (data: Record<string, FormDataConvertible>) => {
  data.repositories = form.repositories
  data.technologies = form.technologies
  return { ...data }
}
</script>

<template>
  <PageHeader value="Project" />
  <Form v-if="project" :action="`/portfolio/projects/${project.id}`" method="put" :transform="data => transformData(data)">
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
    <Field class="mb-4">
      <Label for="repositories">Repositories</Label>
      <RepositorySelect
        v-model="form.repositories"
        :repositories="$props.repositories" />
    </Field>
    <Field class="mb-4">
      <Label for="technologies">Technologies</Label>
      <TechnologySelect
        v-model="form.technologies"
        :technologies="$props.technologies" />
    </Field>
    <Button
      class="cursor-pointer"
      type="submit">
      Save
    </Button>
  </Form>
</template>
