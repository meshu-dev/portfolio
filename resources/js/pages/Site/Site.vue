<script setup lang="ts">
import { useForm } from '@inertiajs/vue3'
import { Form } from '@inertiajs/vue3'
import { Field } from '@/components/ui/field'
import Label from '@/components/ui/label/Label.vue'
import Input from '@/components/ui/input/Input.vue'
import Button from '@/components/ui/button/Button.vue'
import PageHeader from '@/components/PageHeader.vue'
import { Site } from '@/types/portfolio'
import ImageView from '@/components/Image/ImageView.vue'
import ImageField from '@/components/Image/ImageField.vue'

const props = defineProps({ site: Object })
const site: Site|null = props.site.data ? props.site.data as Site : null

console.log('site', site, props)

const formUrl: string = site ? `/sites/${site.id}` : '/sites'
const formMethod: string = site ? 'put' : 'post'

const form = useForm({
  name: site?.name,
  url: site?.url,
  image: null,
  image_url: site?.image_url || '',
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

<style scoped>
  >>> img {
    max-width: 100px;
  }
</style>
