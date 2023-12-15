<template>
    <textarea
        ref="textarea"
        placeholder="Enter your message here"
        class="mt-1 block w-full rounded-md border-0 bg-skin-neutral-1 px-3 py-2 text-skin-neutral-12 placeholder-skin-neutral-9 shadow-sm ring-1 ring-inset ring-skin-neutral-7 focus:ring-2 focus:ring-inset focus:ring-skin-neutral-7 sm:text-sm sm:leading-6"
        :class="{ 'overflow-y-hidden': autoResize }"
        :value="modelValue"
        @input="handleInput"
    ></textarea>
</template>

<script setup>
import { ref, onMounted } from 'vue'

const props = defineProps({
    modelValue: {
        type: [String, null],
        required: true
    },
    autoResize: {
        type: Boolean,
        default: true
    }
})

onMounted(() => {
    if (props.autoResize) {
        resizeTextarea()
    }
})

const emit = defineEmits(['update:modelValue'])
const textarea = ref(null)

function handleInput() {
    const value = textarea.value.value
    emit('update:modelValue', value)
    if (props.autoResize) {
        resizeTextarea()
    }
}

function resizeTextarea() {
    if (textarea.value) {
        textarea.value.style.height = `${textarea.value.scrollHeight}px`
    }
}
</script>

<style scoped>
* {
    scrollbar-width: thin;
    scrollbar-color: theme('colors.skin.neutral.7')
        theme('colors.skin.neutral.1');
}

::-webkit-scrollbar {
    background-color: theme('colors.skin.neutral.1');
}

::-webkit-scrollbar-corner {
    background-color: theme('colors.skin.neutral.1');
}

::-webkit-scrollbar-corner,
::-webkit-scrollbar-track {
    background-color: theme('colors.skin.neutral.7');
}

::-webkit-scrollbar-thumb {
    background-color: theme('colors.skin.neutral.1');
    border-radius: 20px;
    border: 3px solid theme('colors.skin.neutral.7');
}
</style>
