<script setup lang="ts">
import { useForm } from '@inertiajs/vue3'
import { Form } from '@inertiajs/vue3'
import { Field } from '@/components/ui/field'
import Label from '@/components/ui/label/Label.vue'
import Input from '@/components/ui/input/Input.vue'
import Button from '@/components/ui/button/Button.vue'
import PageHeader from '@/components/PageHeader.vue'

/*
const props = defineProps({ line1: String, line2: String })

const form = useForm({
  line1: props.line1,
  line2: props.line2,
}) */
</script>

<template>
  <PageHeader value="About" />
  <Form action="/about" method="put">
  </Form>
</template>
