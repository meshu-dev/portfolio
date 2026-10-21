<script setup lang="ts">
  const about = getAbout()
  console.log('about', about)
</script>

<template>
  <div>
    <PageTitle title="About me" />
    <div class="grid gap-12 md:grid-cols-[1fr_16rem] md:gap-16">
      <div id="about-text" class="max-w-[62ch] font-serif text-xl leading-relaxed text-default" v-html="about?.text"></div>
      <div>
        <h2 class="mb-4 text-xl font-bold text-highlighted">Skills</h2>
        <ul class="border-t border-default">
          <li
            v-for="technology of about?.technologies"
            :key="technology"
            class="border-b border-default py-2.5 text-lg font-medium">{{ technology }}</li>
        </ul>
      </div>
    </div>
  </div>
</template>
