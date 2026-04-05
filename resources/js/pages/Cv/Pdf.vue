<script setup lang="ts">
import { router, useHttp, usePoll } from '@inertiajs/vue3'
import PageHeader from '@/components/PageHeader.vue'
import Button from '@/components/ui/button/Button.vue'
import { getFormattedDate } from '@/lib/utils'
import { onBeforeUnmount, onMounted, ref, Ref } from 'vue'
import { FlashMessage, PdfFile } from '@/types/portfolio'
import { FlashTypeEnum } from '@/enums/FlashTypeEnum'

let props = defineProps({ pdf: Object })
const pdf: Ref<PdfFile|null> = ref(null)

const http = useHttp()

const createPdf = () => {
  router.post(
    `/cv/pdf`,
    {},
    {
      onSuccess: () => {
        stop()
        start()
      }
    }
  )
}

const onPollStart = () => {
  http.get('/cv/pdf/file', {
    onSuccess: (response: unknown): void => {
      const responsePdf: PdfFile|null = response ? response as PdfFile : null

      if (
        (pdf.value === null && responsePdf?.id) ||
        (pdf.value && responsePdf && pdf.value.updated_at != responsePdf.updated_at)
      ) {
        const flashMessage: FlashMessage = {
          message: "Pdf has been updated",
          type: FlashTypeEnum.SUCCESS
        }
        router.flash(() => (flashMessage))

        pdf.value = responsePdf
      }
    },
  })
}

const onPollFinish = () => {
  stop()
}

const { start, stop } = usePoll(
    2000,
    { onStart: onPollStart, onFinish: onPollFinish },
    { autoStart: false }
)

onBeforeUnmount(() => stop())
</script>

<template>
    <PageHeader value="PDF File" />
    <template v-if="pdf">
        <p class="mb-4">PDF file has been created.</p>
        <p class="flex mb-4 gap-1">
            <span class="font-bold">Url:</span>
            <span>
                <a :href="pdf.url" target="_blank" class="hover:underline">{{ pdf.url }}</a>
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