<template>
    <div>
        <ul v-for="(item, index) in items" :key="index">
            <AppMenuSection :item="item" />
        </ul>
    </div>
</template>

<script setup>
defineProps({
    items: {
        type: Array,
        default: () => []
    }
})
</script>
