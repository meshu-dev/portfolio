<script setup lang="ts">
import { useForm } from '@inertiajs/vue3'
import Label from '@/components/ui/label/Label.vue'
import Input from '@/components/ui/input/Input.vue'
import { Switch } from '@/components/ui/switch'
import Button from '@/components/ui/button/Button.vue'
import DatePicker from '@/components/DatePicker.vue'
import { WorkExperience } from '@/types/portfolio'
import { dateToCalendarDate } from '@/lib/utils'
import PageHeader from '@/components/PageHeader.vue'

const props = defineProps({ workExperience: Object, errors: Object })
const workExperience: WorkExperience|null = props.workExperience ? props.workExperience as WorkExperience : null
const responsibilityLimit: number = 5

const form = useForm({
  title:            workExperience?.title || '',
  company:          workExperience?.company || '',
  location:         workExperience?.location || '',
  is_current:       !workExperience?.end_date || false,
  start_date:       dateToCalendarDate(workExperience?.start_date || new Date().toDateString()),
  end_date:         dateToCalendarDate(workExperience?.end_date || new Date().toDateString()),
  description:      workExperience?.description || '',
  responsibilities: workExperience?.responsibilities,//JSON.parse(workExperience?.responsibilities),
  active:           workExperience?.active || false,
})

const addResponsibility = (): void => {
  form.responsibilities.push('')
}

const removeResponsibility = (index: number): void => {
  form.responsibilities.splice(index, 1)
}

const submitForm = (): void => {
  const transformParams = (data: any) => {
    data.start_date = form.start_date.toString()
    data.end_date   = form.end_date ? form.end_date.toString() : null
    return data
  }

  if (workExperience?.id) {
    form.transform(transformParams).put(`/work-experiences/${workExperience.id}`)
  } else {
    form.transform(transformParams).post(`/work-experiences`)
  }
  console.log('submitForm')
}
</script>

<template>
  <PageHeader value="Work Experience" />
  <form class="flex flex-col gap-3" @submit.prevent>
    <div class="form-row">
      <Label for="title" class="form-label">Title</Label>
      <Input
        type="text"
        id="title"
        name="title"
        v-model="form.title"
        :class="errors?.name ? `error-field` : ``"
        autoComplete="off" />
      <ErrorMessage v-if="errors?.name" :value="errors?.name" />
    </div>
    <div class="form-row">
      <Label for="company" class="form-label">Company</Label>
      <Input
        type="text"
        id="company"
        name="company"
        v-model="form.company"
        :class="errors?.company ? `error-field` : ``"
        autoComplete="off" />
      <ErrorMessage v-if="errors?.company" :value="errors?.company" />
    </div>
    <div class="form-row">
      <Label for="company" class="form-label">Location</Label>
      <Input
        type="text"
        id="location"
        name="location"
        v-model="form.location"
        :class="errors?.location ? `error-field` : ``"
        autoComplete="off" />
      <ErrorMessage v-if="errors?.location" :value="errors?.location" />
    </div>
    <div class="form-row">
      <Label for="current" class="form-label">Current Employer</Label>
      <Switch id="current" v-model="form.is_current" :class="errors?.is_current ? `error-field` : ``" />
      <ErrorMessage v-if="errors?.is_current" :value="errors?.is_current" />
    </div>
    <div class="form-row">
      <Label for="current" class="form-label">Start Date</Label>
      <DatePicker v-model="form.start_date" />
      <ErrorMessage v-if="errors?.start_date" :value="errors?.start_date" />
    </div>
    <div v-if="!form.is_current" class="form-row">
      <Label for="current" class="form-label">End Date</Label>
      <DatePicker v-model="form.end_date" />
      <ErrorMessage v-if="errors?.end_date" :value="errors?.end_date" />
    </div>
    <div class="form-row">
      <Label for="description" class="form-label">Description</Label>
      <Input
        type="text"
        id="description"
        name="description"
        v-model="form.description"
        :class="errors?.description ? `error-field` : ``"
        autoComplete="off" />
      <ErrorMessage v-if="errors?.description" :value="errors?.description" />
    </div>
    <div class="form-row">
      <Label for="description" class="form-label">Responsibilities</Label>
      <Button
        class="w-20 mb-4 cursor-pointer"
        variant="outline"
        @click="addResponsibility"
        :disabled="form.responsibilities && form.responsibilities.length === responsibilityLimit">
        Add
      </Button>
      <div
        v-for="(,index) in form.responsibilities"
        class="flex flex-col sm:flex-row mb-4 gap-2">
        <Input
          type="text"
          id="location"
          name="location"
          v-model="form.responsibilities[index]"
          :class="errors && errors[`responsibilities${index}`] ? `error-field` : ``"
          autoComplete="off" />
        <Button class="w-20 cursor-pointer" @click="removeResponsibility(index)">
          Remove
        </Button>
      </div>
      <ErrorMessage v-if="errors?.responsibilities" :value="errors?.responsibilities" />
    </div>
    <div class="form-row">
      <Label for="active" class="form-label">Active</Label>
      <Switch id="active" v-model="form.active" :class="errors?.active ? `error-field` : ``" />
      <ErrorMessage v-if="errors?.active" :value="errors?.active" />
    </div>
    <div class="form-row">
      <Button
        size="lg"
        class="w-20 cursor-pointer"
        @click="submitForm">
        Save
      </Button>
    </div>
  </form>
</template>