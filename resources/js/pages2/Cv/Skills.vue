<script setup lang="ts">
import { Form, useForm } from '@inertiajs/vue3'
import Label from '@/components/ui/label/Label.vue'
import {
  Select,
  SelectContent,
  SelectItem,
  SelectTrigger,
  SelectValue,
} from '@/components/ui/select'
import Button from '@/components/ui/button/Button.vue'
import { Technology } from '@/types/portfolio'
import PageHeader from '@/components/PageHeader.vue'
import ErrorMessage from '@/components/ErrorMessage.vue'

const props = defineProps({ skills: Object, technologies: Object, errors: Object })

const formProps: {[key: string]: string} = {}

for (const skill of props.skills) {
  formProps[skill.id] = skill.technologies.map((technology: Technology) => technology.id);
}

const form = useForm(formProps)

const transformData = (data) => {
  let params: { id: string, technologies: string[] }[] = []

  for (const skillId of Object.keys(formProps)) {
    params.push({ id: skillId, technologies: form[skillId] })
  }
  data.skills = params
  return { ...data }
}

</script>

<template>
  <PageHeader value="Skills" />
  <Form action="/cv/skills" method="put" :transform="data => transformData(data)">
    <div v-for="(skill, index) in skills" class="mb-5">
      <Label :for="skill.name" class="mb-3">{{ skill.name }}</Label>
      <Select multiple v-model:modelValue="form[skill.id]" class="w-full">
        <SelectTrigger class="w-full">
          <SelectValue placeholder="Select technology" />
        </SelectTrigger>
        <SelectContent>
          <SelectItem  v-for="technology in technologies" :value="technology.id" selected>
            {{ technology.name }}
          </SelectItem>
        </SelectContent>
      </Select>
      <ErrorMessage v-if="errors && errors[`skills.${index}.technologies`]" :value="errors[`skills.${index}.technologies`]" />
    </div>
    <Button
      class="cursor-pointer"
      type="submit">
      Save
    </Button>
  </Form>
</template>