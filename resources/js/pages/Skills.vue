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

const props = defineProps({ skills: Object, technologies: Object })

const formProps: {[key: string]: string} = {};

for (const skill of props.skills) {
  formProps[skill.name] = skill.technologies.map((technology: Technology) => technology.id);
}

const form = useForm(formProps)
</script>

<template>
  <h1>Skills</h1>
  <Form action="/skills" method="post">
    <div v-for="skill in skills" class="mb-5">
      <Label :for="skill.name" class="mb-3">{{ skill.name }}</Label>
      <Select multiple v-model:modelValue="form[skill.name]">
        <SelectTrigger class="w-xl">
          <SelectValue placeholder="Select technology" />
        </SelectTrigger>
        <SelectContent>
          <SelectItem  v-for="technology in technologies" :value="technology.id" selected>
            {{ technology.name }}
          </SelectItem>
        </SelectContent>
      </Select>
    </div>
    <Button
      class="cursor-pointer"
      type="submit">
      Save
    </Button>
  </Form>
</template>