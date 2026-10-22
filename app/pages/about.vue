<script setup lang="ts">
  const about = getAbout()
  console.log('about', about)
</script>

<template>
  <div>
    <PageTitle title="About me" />
    <div class="grid gap-10 md:grid-cols-[16rem_1fr] md:gap-16">
      <img
        v-if="about?.image_url"
        :src="about.image_url"
        alt="About me"
        class="aspect-[4/5] w-48 self-start rounded-sm object-cover md:w-full" >
      <div>
        <!-- eslint-disable-next-line vue/no-v-html -- the bio is HTML the site owner writes in the admin app -->
        <div id="about-text" class="max-w-[62ch] font-serif text-xl leading-relaxed text-default" v-html="about?.text"/>
        <h2 class="mb-4 mt-12 text-xl font-bold text-highlighted">Skills</h2>
        <ul class="grid border-t border-default sm:grid-cols-2 sm:gap-x-10">
          <li
            v-for="technology of about?.technologies"
            :key="technology"
            class="border-b border-default py-2.5 text-lg font-medium">{{ technology }}</li>
        </ul>
      </div>
    </div>
  </div>
</template>
