<script setup lang="ts">
import { router } from '@inertiajs/vue3'
import PageHeader from '@/components/PageHeader.vue'
import Button from '@/components/ui/button/Button.vue'

defineProps({ pdf: Object })

const createPdf = () => {
  router.post(`/cv/pdf`)
}
</script>

<template>
    <PageHeader value="PDF File" />
    <template v-if="pdf">
        <div>PDF file has been generated.</div>
        <Button
            class="btn-primary cursor-pointer"
            @click="createPdf()">
            Create New Pdf
        </Button>
    </template>
    <template v-else>
        <div class="mb-4">A PDF file of the CV hasn't been created yet.</div>
        <Button
            class="btn-primary cursor-pointer"
            @click="createPdf()">
            Create Pdf
        </Button>
    </template>
</template>