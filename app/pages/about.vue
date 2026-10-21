<script setup lang="ts">
  const about = getAbout()
  console.log('about', about)
</script>

<template>
  <div class="flex justify-center">
    <div class="flex flex-col max-w-[900px] gap-4">
      <UPageHeader title="About Me" class="mb-6" />
      <div class="flex flex-col md:flex-row md:items-start gap-8">
        <img
          v-if="about?.image_url"
          :src="about.image_url"
          alt="About me"
          class="w-48 md:w-64 shrink-0 rounded-lg object-cover self-start" />
        <div class="flex flex-col gap-4">
          <div id="about-text" v-html="about?.text"></div>
          <div>
            <h2 class="bold mb-4 text-xl underline underline-offset-8">Skills</h2>
            <ul class="list-disc ml-6">
              <li v-for="technology of about?.technologies" class="mb-2">{{ technology }}</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
