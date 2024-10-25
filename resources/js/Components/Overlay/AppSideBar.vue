<template>
    <div :class="baseClasses" :aria-hidden="!isVisible.toString()">
        <!-- Your Sidebar Content -->
        <div
            class="fixed z-40 h-screen w-64 overflow-y-auto bg-skin-neutral-2 shadow"
        >
            <aside aria-label="Sidebar">
                <div class="h-full overflow-y-auto px-3 py-5">
                    <slot></slot>
                </div>
            </aside>
        </div>
        <transition name="fade">
            <div
                v-if="backdrop && isVisible"
                class="fixed inset-0 bg-skin-neutral-9 opacity-95"
                @click="$emit('sidebar:toggle')"
            ></div>
        </transition>
    </div>
</template>

<script setup>
import { ref, computed, onMounted, onUnmounted } from 'vue'
import useIsMobile from '@/Composables/useIsMobile'

const props = defineProps({
    placement: {
        type: String,
        default: 'left' // default is left, it can be right as well
    },
    bodyScrolling: {
        type: Boolean,
        default: false
    },
    backdrop: {
        type: Boolean,
        default: false
    },
    startsVisible: {
        type: Boolean,
        default: true
    }
})

const emit = defineEmits(['sidebar:toggle'])

const isVisible = ref(true)

onMounted(() => {
    document.addEventListener('inertia:start', hideMenuOnNavigation)

    if (!props.startsVisible) {
        isVisible.value = false
    }
})

onUnmounted(() => {
    document.removeEventListener('inertia:start', hideMenuOnNavigation)
})

const { isMobile } = useIsMobile()
const hideMenuOnNavigation = () => {
    if (isMobile.value && isVisible.value) {
        window.setTimeout(() => {
            emit('sidebar:toggle')
        }, 200)
    }
}

const baseClasses = computed(() => {
    const base = [
        'fixed',
        'transition-transform',
        'h-screen',
        'w-64',
        'overflow-y-auto',
        'transition-all',
        'ease-out',
        'duration-200',
        'z-30'
    ]

    switch (props.placement) {
        case 'right':
            return [
                ...base,
                'top-0',
                'right-0',
                isVisible.value ? 'transform-none' : 'translate-x-full'
            ]
        case 'left':
        default:
            return [
                ...base,
                'top-0',
                'left-0',
                isVisible.value ? 'transform-none' : '-translate-x-full'
            ]
    }
})

const show = () => {
    isVisible.value = true
    if (!props.bodyScrolling) {
        document.body.style.overflow = 'hidden'
    }
}

const hide = () => {
    isVisible.value = false
    if (!props.bodyScrolling) {
        document.body.style.overflow = ''
    }
}

const toggle = () => {
    isVisible.value ? hide() : show()
}

defineExpose({
    toggle
})
</script>

<style scoped>
.fade-enter-active,
.fade-leave-active {
    @apply transition-opacity duration-300 ease-in;
}
.fade-enter-from,
.fade-leave-to {
    @apply opacity-0;
}
</style>
