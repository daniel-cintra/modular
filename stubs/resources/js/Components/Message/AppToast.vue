<template>
    <transition name="fade" @after-leave="afterLeave">
        <div v-if="isVisible" :class="toastClass">
            <slot></slot>
        </div>
    </transition>
</template>

<script setup>
import { ref, computed } from 'vue'

const props = defineProps({
    placement: {
        type: String,
        default: 'top-end',
        validator: (value) =>
            [
                'top-start',
                'top',
                'top-end',
                'middle-start',
                'middle',
                'middle-end',
                'bottom-start',
                'bottom',
                'bottom-end'
            ].includes(value)
    },

    duration: {
        type: Number,
        default: 5000
    }
})

const emit = defineEmits(['toast:closed'])

let isVisible = ref(false)

const toastClass = computed(() => {
    const baseClass = 'fixed z-50'
    switch (props.placement) {
        case 'top-start':
            return `${baseClass} top-4 left-4`
        case 'top':
            return `${baseClass} top-4 left-1/2 transform -translate-x-1/2`
        case 'top-end':
            return `${baseClass} top-6 right-6`
        case 'middle-start':
            return `${baseClass} top-1/2 left-4 transform -translate-y-1/2`
        case 'middle':
            return `${baseClass} top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2`
        case 'middle-end':
            return `${baseClass} top-1/2 right-4 transform -translate-y-1/2`
        case 'bottom-start':
            return `${baseClass} bottom-4 left-4`
        case 'bottom':
            return `${baseClass} bottom-4 left-1/2 transform -translate-x-1/2`
        case 'bottom-end':
            return `${baseClass} bottom-4 right-4`
        default:
            return baseClass
    }
})

const open = () => {
    isVisible.value = true
    window.setTimeout(() => {
        close()
    }, props.duration)
}

const close = () => {
    isVisible.value = false
    emit('toast:closed')
}

const afterLeave = () => {
    // console.log('toast:afterLeave')
}

defineExpose({
    open,
    close
})
</script>

<style scoped>
.fade-enter-active,
.fade-leave-active {
    @apply transition-opacity duration-300 ease-out;
}
.fade-enter-from,
.fade-leave-to {
    @apply opacity-0;
}
</style>
