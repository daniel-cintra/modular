<template>
    <div class="relative mt-1">
        <input
            :value="modelValue"
            v-bind="$attrs"
            class="mt-1 block w-full rounded-md border-0 bg-skin-neutral-1 px-3 py-2 text-skin-neutral-12 placeholder-skin-neutral-6 shadow-sm ring-1 ring-inset ring-skin-neutral-7 focus:ring-2 focus:ring-inset focus:ring-skin-neutral-7 sm:text-sm sm:leading-6"
            :type="inputType"
            @input="$emit('update:modelValue', $event.target.value)"
        />

        <div
            class="absolute inset-y-0 right-0 flex items-center pr-3 hover:cursor-pointer"
        >
            <i
                class="inline-block w-5"
                :class="eyeIcon"
                @click="toggleInput"
            ></i>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue'

defineProps({
    modelValue: {
        type: String,
        required: true
    }
})

defineOptions({
    inheritAttrs: false
})

const inputType = ref('password')
const eyeIcon = ref('ri-eye-line')

const toggleInput = () => {
    inputType.value = inputType.value === 'password' ? 'text' : 'password'
    eyeIcon.value =
        eyeIcon.value === 'ri-eye-line' ? 'ri-eye-off-line' : 'ri-eye-line'
}

defineEmits(['update:modelValue'])
</script>
