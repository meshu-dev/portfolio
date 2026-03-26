<script setup lang="ts">
import type { FormDataConvertible, Errors } from '@inertiajs/core'
import { useForm } from '@inertiajs/vue3'
import { Project, Repository, Technology } from '@/types/portfolio'
import PageHeader from '@/components/PageHeader.vue'
import { Field } from '@/components/ui/field'
import Label from '@/components/ui/label/Label.vue'
import Input from '@/components/ui/input/Input.vue'
import Button from '@/components/ui/button/Button.vue'
import TechnologySelect from '@/components/Technology/TechnologySelect.vue'
import RepositorySelect from '@/components/Repository/RepositorySelect.vue'
import ImageView from '@/components/Image/ImageView.vue'
import ImageField from '@/components/Image/ImageField.vue'
import { ref, Ref } from 'vue'
import ErrorMessage from '@/components/ErrorMessage.vue'

const props = defineProps({ project: Object, repositories: Object, technologies: Object, errors: Object })
const project: Project|null = props.project?.data ? props.project.data as Project : null

console.log('project', project)

const form = useForm({
  name: project?.name || '',
  description: project?.description || '',
  url: project?.url || '',
  repositories: project?.repositories.map((repository: Repository) => repository.id) || [],
  technologies: project?.technologies.map((technology: Technology) => technology.id) || [],
  image: null,
  image_url: project?.image_url || '',
})

const transformParams = (data: Record<string, FormDataConvertible>) => {
  data.repositories = form.repositories
  data.technologies = form.technologies
  data.remove_image = project?.image_url && !form.image_url ? true : false
  return data
}

const submitForm = (): void => {
  if (project?.id) {
    form.transform(transformParams).put(`/portfolio/projects/${project.id}`)
  } else {
    form.transform(transformParams).post(`/portfolio/projects`)
  }
}
</script>

<template>
  <PageHeader value="Project" />
  <form class="flex flex-col gap-3" @submit.prevent>
    <Field class="mb-4">
      <Label for="name">Name</Label>
      <Input
        type="text"
        name="name"
        v-model="form.name"
        :class="errors?.name ? `error-field` : ``"
        autoComplete="off" />
      <ErrorMessage v-if="errors?.name" :value="errors?.name" />
    </Field>
    <Field class="mb-4">
      <Label for="description">Description</Label>
      <Input
        type="text"
        name="description"
        v-model="form.description"
        :class="errors?.description ? `error-field` : ``"
        autoComplete="off" />
      <ErrorMessage v-if="errors?.description" :value="errors?.description" />
    </Field>
    <Field class="mb-4">
      <Label for="url">Url</Label>
      <Input
        type="text"
        name="url"
        v-model="form.url"
        :class="errors?.url ? `error-field` : ``"
        autoComplete="off" />
      <ErrorMessage v-if="errors?.url" :value="errors?.url" />
    </Field>
    <Field class="mb-4">
      <Label for="repositories">Repositories</Label>
      <RepositorySelect
        v-model="form.repositories"
        :class="errors?.repositories ? `error-field` : ``"
        :repositories="$props.repositories" />
      <ErrorMessage v-if="errors?.repositories" :value="errors?.repositories" />
    </Field>
    <Field class="mb-4">
      <Label for="technologies">Technologies</Label>
      <TechnologySelect
        v-model="form.technologies"
        :class="errors?.technologies ? `error-field` : ``"
        :technologies="$props.technologies" />
      <ErrorMessage v-if="errors?.technologies" :value="errors?.technologies" />
    </Field>
    <Field class="flex mb-4">
      <Label for="image">Image</Label>
      <ImageView
        v-if="form.image_url"
        v-model="form.image_url" />
      <ImageField
         v-else
        v-model:image="form.image"
        v-model:progress="form.progress" />
      <ErrorMessage v-if="errors?.image" :value="errors?.image" />
    </Field>
    <Button
      size="lg"
      class="w-20 cursor-pointer"
      @click="submitForm">
      Save
    </Button>
  </form>
</template>
