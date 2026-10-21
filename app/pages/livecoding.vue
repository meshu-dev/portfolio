<script setup lang="ts">
  const livestreams = getLivestreams()

  const youtubeSite = getIntro()?.sites?.find((site) => site.name.toLowerCase() === 'youtube')
  const youtubeStreamsUrl = youtubeSite ? `${youtubeSite.url.replace(/\/$/, '')}/streams` : null
</script>

<template>
  <div class="flex justify-center">
    <div class="w-full">
      <UPageHeader title="Livecoding" description="Recordings of my past coding livestreams." class="mb-6" />
      <div v-if="livestreams?.length" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10">
        <UCard
          v-for="livestream of livestreams"
          :key="livestream.url"
          :ui="{ root: 'flex flex-col', body: 'flex flex-col flex-1' }"
          class="w-full p-0">
          <a :href="livestream.url" target="_blank" rel="noopener" :aria-label="`Watch ${livestream.title}`">
            <img
              v-if="livestream.thumbnail"
              :src="livestream.thumbnail"
              :alt="livestream.title"
              class="w-full aspect-video object-cover" />
          </a>
          <div class="p-4 flex flex-col flex-1">
            <div class="text-sm text-muted">{{ formatDate(livestream.actual_start_at) }}</div>
            <div class="font-semibold text-xl mt-1">{{ livestream.title }}</div>
            <p v-if="livestream.description" class="mt-2 text-muted line-clamp-3">{{ livestream.description }}</p>
            <div class="mt-auto pt-4">
              <UButton :to="livestream.url" target="_blank">Watch</UButton>
            </div>
          </div>
        </UCard>
      </div>
      <p v-else class="text-muted">No livestreams yet.</p>
      <div v-if="youtubeStreamsUrl" class="mt-10 flex justify-center">
        <UButton :to="youtubeStreamsUrl" target="_blank" size="lg">View More</UButton>
      </div>
    </div>
  </div>
</template>
