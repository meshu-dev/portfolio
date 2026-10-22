<script setup lang="ts">
const livestreams = getLivestreams()

const youtubeSite = getIntro()?.sites?.find((site) => site.name.toLowerCase() === 'youtube')
const youtubeStreamsUrl = youtubeSite ? `${youtubeSite.url.replace(/\/$/, '')}/streams` : null
</script>

<template>
  <div>
    <PageTitle title="Livecoding" description="Recordings of my past coding livestreams." />
    <ul v-if="livestreams?.length" class="border-t border-default">
      <li
        v-for="livestream of livestreams"
        :key="livestream.url"
        class="group relative grid gap-4 border-b border-default py-8 md:grid-cols-[8rem_1fr_14rem] md:gap-10"
      >
        <p class="font-medium text-muted md:pt-1">{{ formatDate(livestream.actual_start_at) }}</p>
        <div>
          <h2 class="text-2xl font-bold leading-tight tracking-tight text-highlighted">
            <a
              :href="livestream.url"
              target="_blank"
              rel="noopener"
              class="underline-offset-4 outline-offset-4 after:absolute after:inset-0 group-hover:underline focus-visible:underline focus-visible:outline-2 focus-visible:outline-primary"
              >{{ livestream.title }}</a
            >
          </h2>
          <p v-if="livestream.description" class="mt-3 max-w-[55ch] font-serif text-lg text-toned line-clamp-2">
            {{ livestream.description }}
          </p>
        </div>
        <img
          v-if="livestream.thumbnail"
          :src="livestream.thumbnail"
          alt=""
          class="aspect-video w-full rounded-sm object-cover md:order-last"
        />
      </li>
    </ul>
    <p v-else class="text-lg text-muted">No livestreams yet.</p>
    <div v-if="youtubeStreamsUrl" class="mt-10">
      <UButton :to="youtubeStreamsUrl" target="_blank" size="xl" color="neutral" variant="outline">View More</UButton>
    </div>
  </div>
</template>
