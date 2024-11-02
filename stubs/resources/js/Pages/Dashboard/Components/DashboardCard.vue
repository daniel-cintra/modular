<template>
    <div
        class="shadow-xs flex items-center rounded-lg border border-skin-neutral-4 bg-skin-neutral-2 p-4 hover:cursor-pointer hover:bg-skin-neutral-1"
        @click="$inertia.visit(route(link))"
    >
        <div
            class="mr-4 rounded-full bg-green-100 px-3 py-2 text-green-500 dark:bg-green-500 dark:text-green-100"
        >
            <i :class="icon" class="text-2xl"></i>
        </div>
        <div>
            <p class="mb-2 text-sm font-medium">
                {{ label }}
            </p>
            <p class="text-lg font-semibold">
                {{ count }}
            </p>
        </div>
    </div>
</template>

<script setup>
import useAuthCan from '@/Composables/useAuthCan'

defineProps({
    link: {
        type: String,
        default: null
    },
    count: {
        type: String,
        default: null
    },
    label: {
        type: String,
        default: null
    },
    icon: {
        type: String,
        default: null
    }
})

const { can } = useAuthCan()
</script>
