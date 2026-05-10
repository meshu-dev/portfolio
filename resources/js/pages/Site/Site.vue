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
import { Checkbox } from '@/components/ui/checkbox'
import ErrorMessage from '@/components/ErrorMessage.vue'
import { toRaw } from 'vue'

const props = defineProps({ site: Object, types: Array<Type>, errors: Object })
const site: Site|null = props?.site?.data ? props.site.data as Site : null

console.log('site', site)

const formUrl: string = site ? `/sites/${site.id}` : '/sites'
const formMethod: string = site ? 'put' : 'post'

type FormType = {[key: number]: boolean}
type IconType = {[key: string]: string}

const formTypes: FormType = {}
const formIcons: IconType = {}

props?.types?.forEach((type: Type) => {
  const siteType: Type|undefined = site?.types.find((siteType: Type) => siteType.id == type.id)
  formTypes[type.id] = siteType ? true : false
  formIcons[type.key] = site?.icons && site?.icons[type.key] ? site?.icons[type.key] : ''
})

const form = useForm({
  name: site?.name,
  url: site?.url,
  icons: formIcons,
  types: formTypes,
})

const transformData = (data: Record<string, FormDataConvertible>)  => {
  // console.log('FORM!', toRaw(form.icons), data, { ...data, icons: toRaw(form.icons) })

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

  return { ...data, icons: form.icons }
}
</script>

<template>
  <PageHeader value="Site" />
  <Form :action="formUrl" :method="formMethod" :transform="transformData">
    <Field class="mb-4">
      <Label for="name">Name</Label>
      <Input type="text" name="name" :class="errors?.name ? `error-field` : ``" v-model="form.name" autoComplete="off" />
      <ErrorMessage v-if="errors?.name" :value="errors?.name" />
    </Field>
    <Field class="mb-4">
      <Label for="url">Url</Label>
      <Input type="text" name="url" :class="errors?.url ? `error-field` : ``" v-model="form.url" autoComplete="off" />
      <ErrorMessage v-if="errors?.url" :value="errors?.url" />
    </Field>
    <Field class="flex mb-4">
      <Label for="image">Type</Label>
      <div v-for="type in $props.types">
        <div class="flex gap-2 mb-2">
          <Checkbox :id="`type-${type.id}`" v-model:modelValue="form.types[type.id]" class="cursor-pointer" />
          <Label :for="`type-${type.id}`" class="cursor-pointer">{{ type.name }}</Label>
        </div>
        <Input
          v-if="form.types[type.id]"
          type="text"
          name="icons"
          :class="errors?.icon ? `error-field` : ``"
          v-model="form.icons[type.key]"
          autoComplete="off" />
      </div>
      <ErrorMessage v-if="errors?.types" :value="errors?.types" />
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
