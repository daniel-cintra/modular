<template>
    <span v-if="!item.href" class="opacity-50">{{ __(item.label) }}</span>

    <Link v-if="item.href" :href="item.href" class="hover:underline">
        {{ __(item.label) }}
    </Link>

    <span v-if="!item.last"> > </span>
</template>

<script setup>
defineProps({
    item: {
        type: Object,
        default: () => {}
    }
})
</script>
