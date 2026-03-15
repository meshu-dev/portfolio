<script setup lang="ts">
import type { FormDataConvertible } from '@inertiajs/core'
import { useForm } from '@inertiajs/vue3'
import { Form } from '@inertiajs/vue3'
import { Field } from '@/components/ui/field'
import Label from '@/components/ui/label/Label.vue'
import Input from '@/components/ui/input/Input.vue'
import Button from '@/components/ui/button/Button.vue'
import PageHeader from '@/components/PageHeader.vue'
import type { Site, Type } from '@/types/portfolio'
import ImageView from '@/components/Image/ImageView.vue'
import ImageField from '@/components/Image/ImageField.vue'
import { Checkbox } from '@/components/ui/checkbox'

const props = defineProps({ site: Object, types: Array<Type> })
const site: Site|null = props?.site?.data ? props.site.data as Site : null

const formUrl: string = site ? `/sites/${site.id}` : '/sites'
const formMethod: string = site ? 'put' : 'post'

type FormType = {[key: number]: boolean}
const formTypes: FormType = {}

props?.types?.forEach((type: Type) => {
  const siteType: Type|undefined = site?.types.find((siteType: Type) => siteType.id == type.id)
  formTypes[type.id] = siteType ? true : false
})

const form = useForm({
  name: site?.name,
  url: site?.url,
  image: null,
  image_url: site?.image_url || '',
  types: formTypes,
})

const transformData = (data: Record<string, FormDataConvertible>)  => {
  if (!props.types) {
    return { ...data }
  }

  const typeIds: number[] = []

  for (const type of props.types) {
    if (form.types[type.id]) {
      typeIds.push(type.id)
    }
  }

  data.types = typeIds
  return { ...data }
}
</script>

<template>
  <PageHeader value="Site" />
  <Form :action="formUrl" :method="formMethod" :transform="transformData">
    <Field class="mb-4">
      <Label for="name">Name</Label>
      <Input type="text" name="name" v-model="form.name" autoComplete="off" />
    </Field>
    <Field class="mb-4">
      <Label for="url">Url</Label>
      <Input type="text" name="url" v-model="form.url" autoComplete="off" />
    </Field>
    <Field class="flex mb-4">
      <Label for="image">Type</Label>
      <div v-for="type in $props.types" class="flex gap-2 mb-2">
        <Checkbox :id="`type-${type.id}`" v-model:modelValue="form.types[type.id]" class="cursor-pointer" />
        <Label :for="`type-${type.id}`" class="cursor-pointer">{{ type.name }}</Label>
      </div>
    </Field>
    <Field class="flex mb-4">
      <Label>Image</Label>
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

<style scoped>
  >>> img {
    max-width: 100px;
  }
</style>
