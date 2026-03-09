<script setup lang="ts">
import { useForm } from '@inertiajs/vue3'
import { Form } from '@inertiajs/vue3'
import { Field } from '@/components/ui/field'
import Label from '@/components/ui/label/Label.vue'
import Input from '@/components/ui/input/Input.vue'
import Button from '@/components/ui/button/Button.vue'
import PageHeader from '@/components/PageHeader.vue'

const props = defineProps({ intro: String, location: String })

const form = useForm({
  intro: props.intro,
  location: props.location,
})
</script>

<template>
  <PageHeader value="Profile" />
  <Form action="/cv/profile" method="put">
    <Field class="mb-4">
      <Label for="intro">Intro</Label>
      <Input type="text" name="intro" v-model="form.intro" autoComplete="off" placeholder="Intro" />
    </Field>
    <Field class="mb-4">
      <Label for="location">Location</Label>
      <Input type="text" name="location" v-model="form.location" autoComplete="off" placeholder="Password" />
    </Field>
    <Button
      class="cursor-pointer"
      type="submit">
      Save
    </Button>
  </Form>
</template>