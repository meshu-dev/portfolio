<script setup lang="ts">
import { useForm } from '@inertiajs/vue3'
import { Form } from '@inertiajs/vue3'
import { Field } from '@/components/ui/field'
import Label from '@/components/ui/label/Label.vue'
import Input from '@/components/ui/input/Input.vue'
import Button from '@/components/ui/button/Button.vue'
import PageHeader from '@/components/PageHeader.vue'
import ErrorMessage from '@/components/ErrorMessage.vue'

const props = defineProps({ intro: String, location: String, errors: Object })

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
      <Input
        type="text"
        name="intro"
        :class="errors?.intro ? `error-field` : ``"
        v-model="form.intro"
        autoComplete="off"
        placeholder="Intro" />
      <ErrorMessage v-if="errors?.intro" :value="errors?.intro" />
    </Field>
    <Field class="mb-4">
      <Label for="location">Location</Label>
      <Input
        type="text"
        name="location"
        :class="errors?.location ? `error-field` : ``"
        v-model="form.location"
        autoComplete="off"
        placeholder="Password" />
      <ErrorMessage v-if="errors?.location" :value="errors?.location" />
    </Field>
    <Button
      class="cursor-pointer"
      type="submit">
      Save
    </Button>
  </Form>
</template>