<template>
  <header class="mx-8 my-4">
    <nav class="" aria-label="Top">
      <div class="flex w-full items-center justify-between py-6">
        <div class="flex items-center">
          <div>
            <h2 class="text-2xl">{{ title }}</h2>
            <AppBreadCrumb :items="breadCrumb"></AppBreadCrumb>
          </div>
        </div>
        <div class="ml-10 space-x-4">
          <slot name="right" />
        </div>
      </div>
    </nav>
  </header>
</template>

<script setup>
import AppBreadCrumb from '@/Components/AppBreadCrumb.vue'

const props = defineProps({
  title: {
    type: String,
    default: '-'
  },
  breadCrumb: {
    type: Array,
    default: () => []
  }
})
</script>
