<script setup lang="ts">
import type { FormDataConvertible, GlobalEventCallback, RequestPayload } from '@inertiajs/core'
import { router, useForm, usePage } from '@inertiajs/vue3'
import { Form } from '@inertiajs/vue3'
import { Field } from '@/components/ui/field'
import Label from '@/components/ui/label/Label.vue'
import Button from '@/components/ui/button/Button.vue'
import PageHeader from '@/components/PageHeader.vue'
import { Textarea } from '@/components/ui/textarea'
import {
  Select,
  SelectContent,
  SelectItem,
  SelectTrigger,
  SelectValue,
} from '@/components/ui/select'
import { About, Technology } from '@/types/portfolio'
import ImageView from '@/components/Image/ImageView.vue'
import ImageField from '@/components/Image/ImageField.vue'
import { getFormOptions } from '@/lib/utils'

const props = defineProps({ about: Object, technologies: Object })
const about: About|null = props?.about.data ? props.about.data as About : null

const formOptions = getFormOptions()
formOptions['only'].push('about')

const form = useForm({
  text: about?.text,
  skillTechnologies: about?.technologies.map((technology: Technology) => technology.id),
  image: null,
  image_url: about?.image_url || '',
})

const transformData = (data: Record<string, FormDataConvertible>)  => {
  data.technologies = form.skillTechnologies
  return { ...data }
}

const handleSuccess = (payload: RequestPayload): void => {
  console.log('payload', payload)
  form.image_url = payload.props?.about.data.image_url || ''
  router.reload()
}
</script>

<template>
  <PageHeader value="About" />
  <Form
    action="/portfolio/about"
    method="put"
    :options="formOptions"
    :transform="transformData"
    @success="handleSuccess">
    <Field class="mb-4">
      <Label for="text">Text</Label>
      <Textarea name="text" v-model="form.text" autoComplete="off" placeholder="Type about text here" class="min-h-[200px]" />
    </Field>
    <Field class="mb-4">
      <Label for="skills">Skills</Label>
      <Select name="technologies" multiple v-model:modelValue="form.skillTechnologies">
        <SelectTrigger class="w-xl">
          <SelectValue placeholder="Select technology" />
        </SelectTrigger>
        <SelectContent>
          <SelectItem  v-for="technology in technologies" :value="technology.id" selected>
            {{ technology.name }}
          </SelectItem>
        </SelectContent>
      </Select>
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
    </Field>
    <Button
      class="cursor-pointer"
      type="submit">
      Save
    </Button>
  </Form>
</template>
