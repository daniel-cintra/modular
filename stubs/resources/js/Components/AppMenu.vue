<template>
  <div>
    <ul v-for="(item, index) in items" :key="index" class="block">
      <app-menu-section :item="item" />
    </ul>
  </div>
</template>

<script setup>
import AppMenuSection from '@/Components/AppMenuSection.vue'

const props = defineProps({
  items: {
    type: Array,
    default: () => []
  }
})
</script>
