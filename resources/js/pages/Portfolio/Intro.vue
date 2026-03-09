<script setup lang="ts">
import { useForm } from '@inertiajs/vue3'
import { Form } from '@inertiajs/vue3'
import { Field } from '@/components/ui/field'
import Label from '@/components/ui/label/Label.vue'
import Input from '@/components/ui/input/Input.vue'
import Button from '@/components/ui/button/Button.vue'
import PageHeader from '@/components/PageHeader.vue'

const props = defineProps({ line1: String, line2: String })

const form = useForm({
  line1: props.line1,
  line2: props.line2,
})
</script>

<template>
  <PageHeader value="Intro" />
  <Form action="/portfolio/intro" method="put">
    <Field class="mb-4">
      <Label for="line1">Line 1</Label>
      <Input type="text" name="line1" v-model="form.line1" autoComplete="off" placeholder="Line 1" />
    </Field>
    <Field class="mb-4">
      <Label for="line2">Line 2</Label>
      <Input type="text" name="line2" v-model="form.line2" autoComplete="off" placeholder="Line 2" />
    </Field>
    <Button
      class="cursor-pointer"
      type="submit">
      Save
    </Button>
  </Form>
</template>
