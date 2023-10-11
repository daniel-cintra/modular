<template>
    <nav aria-label="Breadcrumb">
        <ul>
            <template v-for="item in items" :key="item.label">
                <AppBreadCrumbItem :item="item" />
            </template>
        </ul>
    </nav>
</template>

<script setup>
const props = defineProps({
    items: {
        type: Array,
        default: () => []
    }
})
</script>
