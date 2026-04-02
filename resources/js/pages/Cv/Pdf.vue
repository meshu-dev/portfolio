<script setup lang="ts">
import { router } from '@inertiajs/vue3'
import PageHeader from '@/components/PageHeader.vue'
import Button from '@/components/ui/button/Button.vue'
import { getFormattedDate } from '@/lib/utils'

let props = defineProps({ pdf: Object })

const createPdf = () => {
  router.post(`/cv/pdf`)
}
</script>

<template>
    <PageHeader value="PDF File" />
    <template v-if="pdf">
        <p class="mb-4">PDF file has been created.</p>
        <p class="flex mb-4 gap-1">
            <span class="font-bold">Url:</span>
            <span>
                <a :href="pdf.image_url" target="_blank" class="hover:underline">{{ pdf.image_url }}</a>
            </span>
        </p>
        <p class="flex mb-4 gap-1">
            <span class="font-bold">Last Created At:</span>
            <span>{{ getFormattedDate(pdf.updated_at, 'dddd wo YYYY - HH:mm A') }}</span>
        </p>
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