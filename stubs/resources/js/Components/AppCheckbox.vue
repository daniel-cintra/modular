<template>
    <!-- For Boolean -->
    <input
        v-if="isBooleanType"
        type="checkbox"
        class="text-skin-primary h-4 w-4 rounded focus:ring-2"
        v-bind="$attrs"
        :checked="modelValue"
        @change="updateBooleanValue"
    />

    <!-- For Array -->
    <input
        v-else
        type="checkbox"
        class="text-skin-primary h-4 w-4 rounded focus:ring-2"
        v-bind="$attrs"
        :value="value"
        :checked="isChecked"
        @change="updateArrayValue"
    />
</template>

<script setup>
import { ref, computed, onMounted } from 'vue'

const props = defineProps({
    modelValue: {
        type: [Boolean, Array],
        default: () => []
    },
    value: {
        type: [String, Number, Boolean, Object],
        required: false,
        default: ''
    }
})

// boolean type
const emit = defineEmits(['update:modelValue'])

const isBooleanType = computed(() => typeof props.modelValue === 'boolean')

function updateBooleanValue(event) {
    emit('update:modelValue', event.target.checked)
}

// array type
const isChecked = ref(false)

onMounted(() => {
    if (Array.isArray(props.modelValue)) {
        props.modelValue.forEach((value) => {
            if (value.id === props.value.id) {
                isChecked.value = true
            }
        })
    }
})

const updateArrayValue = (event) => {
    if (Array.isArray(props.modelValue)) {
        const updatedValue = [...props.modelValue]
        if (event.target.checked) {
            updatedValue.push(props.value)
        } else {
            props.modelValue.forEach((value, index) => {
                if (value.id === props.value.id) {
                    updatedValue.splice(index, 1)
                }
            })
        }
        emit('update:modelValue', updatedValue)
    }
}
</script>
