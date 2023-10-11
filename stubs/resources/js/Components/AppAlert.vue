<template>
    <div class="alert" :class="type" role="alert">
        <i :class="iconClass" class="mr-2"></i>
        <slot></slot>
    </div>
</template>

<script setup>
import { computed } from 'vue'

const props = defineProps({
    type: {
        type: String,
        default: 'info',
        validator: (value) => {
            return ['info', 'success', 'warning', 'error'].includes(value)
        }
    }
})

const iconClass = computed(() => {
    return {
        'ri-information-line': props.type === 'info',
        'ri-check-line': props.type === 'success',
        'ri-alert-line': props.type === 'warning',
        'ri-error-warning-line': props.type === 'error'
    }
})
</script>

<style scoped>
.alert {
    @apply flex w-full rounded-lg px-4 py-3 align-middle shadow;
}

.info {
    @apply bg-skin-info-light text-skin-info;
}

.success {
    @apply bg-skin-success-light text-skin-success;
}

.warning {
    @apply bg-skin-warning-light text-skin-warning;
}

.error {
    @apply bg-skin-error-light text-skin-error;
}
</style>
