<script setup lang="ts">
import { useForm } from '@inertiajs/vue3'
import { Form } from '@inertiajs/vue3'
import { Field } from '@/components/ui/field'
import Label from '@/components/ui/label/Label.vue'
import Input from '@/components/ui/input/Input.vue'
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
import { Technology } from '@/types/portfolio'

const props = defineProps({ text: String, skillTechnologies: Object, technologies: Object })

const form = useForm({
  text: props.text,
  skillTechnologies: props.skillTechnologies.map((technology: Technology) => technology.id)
})

const transformData = (data) => {
  data.technologies = form.skillTechnologies
  return { ...data }
}
</script>

<template>
  <PageHeader value="About" />
  <Form action="/portfolio/about" method="put" :transform="data => transformData(data)">
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
    <Button
      class="cursor-pointer"
      type="submit">
      Save
    </Button>
  </Form>
</template>
