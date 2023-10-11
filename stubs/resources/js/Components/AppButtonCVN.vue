<template>
    <component :is="props.as" :disabled="props.disabled" :class="buttonClass">
        <svg
            v-if="props.loading"
            class="absolute h-5 w-5 animate-spin"
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
        >
            <circle
                class="opacity-25"
                cx="12"
                cy="12"
                r="10"
                stroke="currentColor"
                stroke-width="4"
            ></circle>
            <path
                class="opacity-75"
                fill="currentColor"
                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"
            ></path>
        </svg>

        <component
            :is="props.iconLeft"
            :class="['mr-2 h-5 w-5', props.loading && 'invisible']"
        />

        <span :class="[props.loading && 'invisible']">
            <slot />
        </span>

        <component
            :is="props.iconRight"
            v-if="!props.loading"
            :class="['ml-2 h-5 w-5', props.loading && 'invisible']"
        />
    </component>
</template>

<script setup>
import { computed } from 'vue'
import { cva } from 'class-variance-authority'

const props = defineProps({
    iconLeft: Object,
    iconRight: Object,
    loading: Boolean,
    disabled: Boolean,
    as: {
        type: [String, Object],
        default: 'button'
    },
    intent: {
        type: String,
        validator: (val) =>
            ['primary', 'secondary', 'danger', 'text'].includes(val),
        default: 'secondary'
    }
})

const buttonClass = computed(() => {
    return cva(
        'inline-flex items-center justify-center text-sm rounded min-h-[32px] px-3 py-0.5 font-semibold',
        {
            variants: {
                intent: {
                    primary: ' hover:bg-gray-800 bg-black text-white ',
                    secondary: 'bg-black/5 hover:bg-black/10 text-gray-700',
                    danger: 'bg-red-600 text-white hover:bg-red-500',
                    text: 'text-gray-700 hover:bg-black/5'
                },
                disabled: {
                    true: '!bg-gray-100 !text-gray-400 cursor-not-allowed'
                }
            }
        }
    )({
        intent: props.intent,
        disabled: props.disabled
    })
})
</script>
