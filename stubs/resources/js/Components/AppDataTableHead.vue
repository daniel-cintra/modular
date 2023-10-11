<template>
    <thead>
        <tr>
            <th
                v-for="header in headers"
                :key="header"
                class="border-b border-skin-neutral-6 bg-skin-neutral-3 px-6 py-3"
            >
                {{ header }}
            </th>
        </tr>
    </thead>
</template>

<script setup>
defineProps({
    headers: {
        type: Array,
        default: () => []
    }
})
</script>
