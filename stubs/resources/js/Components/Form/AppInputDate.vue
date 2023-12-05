<template>
    <label class="mb-1 flex" :for="name">
        {{ label }}
    </label>

    <input
        type="date"
        :name="name"
        :value="modelValue"
        class="date-picker text-skin-base-neutral-12 focus:ring-skin-primary-focus mt-1 block w-full rounded-md border-0 bg-skin-neutral-1 px-3 py-2 placeholder-skin-neutral-9 shadow-sm ring-1 ring-inset ring-skin-neutral-7 focus:ring-2 focus:ring-inset sm:text-sm sm:leading-6"
        @input="$emit('update:modelValue', $event.target.value)"
    />
</template>

<script setup>
const props = defineProps({
    modelValue: {
        type: String,
        default: ''
    },
    label: {
        type: String,
        default: ''
    },
    name: {
        type: String,
        default: ''
    }
})

const emit = defineEmits(['update:modelValue'])
</script>

<style scoped>
html.dark-theme .date-picker {
    color-scheme: dark;
}
</style>
