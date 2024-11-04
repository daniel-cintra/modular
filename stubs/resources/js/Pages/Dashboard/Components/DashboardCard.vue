<template>
    <div
        class="shadow-xs flex items-center rounded-lg border border-skin-neutral-4 bg-skin-neutral-2 p-4 transition-all duration-300 hover:cursor-pointer hover:bg-skin-neutral-3"
        @click="$inertia.visit(route(link))"
    >
        <div class="mr-4 rounded-full px-3 py-2" :class="color">
            <i :class="icon" class="text-2xl"></i>
        </div>
        <div>
            <p class="mb-2 font-semibold">
                {{ label }}
            </p>
            <p>
                {{ count }}
            </p>
        </div>
    </div>
</template>

<script setup>
defineProps({
    link: {
        type: String,
        default: null
    },
    count: {
        type: Number,
        default: null
    },
    label: {
        type: String,
        default: null
    },
    icon: {
        type: String,
        default: null
    },
    color: {
        type: String,
        default: 'info',
        validator: (value) => {
            return ['info', 'success', 'warning', 'danger'].includes(value)
        }
    }
})
</script>

<style scoped>
.info {
    @apply bg-skin-info-light text-skin-info;
}

.success {
    @apply bg-skin-success-light text-skin-success;
}

.warning {
    @apply bg-skin-warning-light text-skin-warning;
}

.danger {
    @apply bg-skin-error-light text-skin-error;
}
</style>
