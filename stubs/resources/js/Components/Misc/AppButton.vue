<template>
    <button type="button" @click="$emit('click')">
        <slot></slot>
    </button>
</template>

<script setup>
defineEmits(['click'])
</script>

<style scoped>
.btn {
    @apply z-0 flex items-center rounded-md px-4 py-2 text-sm font-medium transition-colors focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2;
}

.btn-primary {
    @apply bg-skin-primary-9 text-skin-primary-1 hover:bg-skin-primary-10 focus-visible:outline-skin-primary-9;
}

.btn-secondary {
    @apply bg-skin-primary-3 text-skin-primary-11 hover:bg-skin-primary-4 focus-visible:outline-skin-primary-11;
}

.btn-neutral {
    @apply bg-skin-neutral-3 text-skin-neutral-12 hover:bg-skin-neutral-4 focus-visible:outline-skin-neutral-11;
}

.btn-destructive {
    @apply bg-skin-error text-skin-error-light hover:bg-skin-error-dark focus:ring-skin-error;
}

.btn-primary-outline {
    @apply border border-skin-primary-7 text-skin-primary-11 hover:bg-skin-primary-4 focus-visible:outline-skin-primary-11;
}

.btn-neutral-outline {
    @apply border border-skin-neutral-7 text-skin-neutral-12 hover:bg-skin-neutral-4 focus-visible:outline-skin-neutral-11;
}

.btn-icon {
    @apply h-8  rounded-md px-3;
}
</style>
