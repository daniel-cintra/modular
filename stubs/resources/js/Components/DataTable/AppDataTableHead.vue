<template>
    <thead>
        <tr>
            <th
                v-for="header in headers"
                :key="header"
                class="border border-skin-neutral-6 bg-skin-neutral-5 px-2 py-2"
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
