<template>
  <span v-if="!item.href" class="text-skin-base-300">{{ item.label }}</span>

  <Link v-if="item.href" :href="item.href">{{ item.label }}</Link>

  <span v-if="!item.last"> > </span>
</template>

<script setup>
const props = defineProps({
  item: {
    type: Object,
    default: () => {}
  }
})
</script>
