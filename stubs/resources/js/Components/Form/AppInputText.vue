<template>
    <input
        ref="inputRef"
        :value="modelValue"
        class="text-skin-base-neutral-12 focus:ring-skin-primary-focus mt-1 block w-full rounded-md border-0 bg-skin-neutral-1 px-3 py-2 placeholder-skin-neutral-9 shadow-sm ring-1 ring-inset ring-skin-neutral-7 focus:ring-2 focus:ring-inset sm:text-sm sm:leading-6"
        @input="$emit('update:modelValue', $event.target.value)"
    />
</template>

<script setup>
import { ref } from 'vue'

const props = defineProps({
    modelValue: {
        type: String,
        default: ''
    }
})

const emit = defineEmits(['update:modelValue'])

const inputRef = ref(null)

const focusInput = () => {
    inputRef.value.focus()
}

defineExpose({
    focusInput
})
</script>
