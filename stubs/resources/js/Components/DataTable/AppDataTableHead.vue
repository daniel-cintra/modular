<template>
    <thead>
        <tr>
            <th
                v-for="header in headers"
                :key="header"
                class="border-b border-skin-neutral-5 bg-skin-neutral-5 px-4 py-2"
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
