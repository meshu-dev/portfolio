<script setup lang="ts">
import { useForm } from '@inertiajs/vue3'
import { Form } from '@inertiajs/vue3'
import { Field } from '@/components/ui/field'
import Label from '@/components/ui/label/Label.vue'
import Input from '@/components/ui/input/Input.vue'
import Button from '@/components/ui/button/Button.vue'
import PageHeader from '@/components/PageHeader.vue'
import { Site } from '@/types/portfolio'

const props = defineProps({ site: Object })
const site: Site|null = props.site ? props.site as Site : null

console.log('site', site, props)

const formUrl: string = site ? `/sites/${site.id}` : '/sites/new'
const formMethod: string = site ? 'put' : 'post'

const form = useForm({
  name: site?.name,
  url: site?.url,
})
</script>

<template>
  <PageHeader value="Site" />
  <Form :action="formUrl" :method="formMethod">
    <Field class="mb-4">
      <Label for="name">Name</Label>
      <Input type="text" name="name" v-model="form.name" autoComplete="off" />
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
