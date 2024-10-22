<template>
    <div class="mb-4 flex items-center">
        <AppLabel class="hover:cursor-pointer" :for="$attrs.id">
            <input
                v-bind="$attrs"
                type="radio"
                :checked="isChecked"
                class="h-4 w-4 text-skin-primary-9 hover:cursor-pointer focus:ring-2 focus:ring-skin-primary-7"
                @change="$emit('update:modelValue', value)"
            />

            <slot></slot>
        </AppLabel>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'

const props = defineProps({
    modelValue: {
        type: [String, Number, Boolean],
        default: false
    },
    value: {
        type: [String, Number, Boolean],
        default: false
    }
})

defineOptions({
    inheritAttrs: false
})

const isChecked = ref(false)

onMounted(() => {
    if (props.value === props.modelValue) {
        isChecked.value = true
    }
})

defineEmits(['update:modelValue'])
</script>
