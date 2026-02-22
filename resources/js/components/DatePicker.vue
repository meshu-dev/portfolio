<script setup lang="ts">
import type { DateValue } from '@internationalized/date'
import { CalendarDate, DateFormatter, getLocalTimeZone, today } from '@internationalized/date'

import { CalendarIcon } from 'lucide-vue-next'
import { cn, dateToCalendarDate } from '@/lib/utils'
import { Button } from '@/components/ui/button'
import { Calendar } from '@/components/ui/calendar'
import {
  Popover,
  PopoverContent,
  PopoverTrigger,
} from '@/components/ui/popover'
import { ref, Ref } from 'vue'

const defaultPlaceholder = today(getLocalTimeZone())
const props = defineProps({ date: String })
const date: CalendarDate = dateToCalendarDate(props.date || (new Date()).toDateString())
const df = new DateFormatter('en-US', {
  dateStyle: 'long',
})
</script>

<template>
  <Popover v-slot="{ close }">
    <PopoverTrigger as-child>
      <Button
        variant="outline"
        :class="cn('w-[240px] justify-start text-left font-normal', !date && 'text-muted-foreground')"
      >
        <CalendarIcon />
        {{ date ? df.format(date.toDate(getLocalTimeZone())) : "Pick a date" }}
      </Button>
    </PopoverTrigger>
    <PopoverContent class="w-auto p-0" align="start">
      <Calendar
        v-model="date"
        :default-placeholder="defaultPlaceholder"
        layout="month-and-year"
        initial-focus
        @update:model-value="close"
      />
    </PopoverContent>
  </Popover>
</template>
