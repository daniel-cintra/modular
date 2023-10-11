<template>
    <div class="relative inline-block">
        <!-- Trigger -->
        <div @mouseover="showTooltip = true" @mouseout="showTooltip = false">
            <slot></slot>
        </div>

        <!-- Tooltip -->
        <transition name="fade">
            <div
                v-show="showTooltip"
                class="absolute inline-flex rounded bg-skin-neutral-10 p-2 text-xs text-skin-neutral-1 transition-opacity duration-500 ease-in-out"
                :class="tooltipClass"
                :style="tooltipStyle"
            >
                {{ text }}
            </div>
        </transition>
    </div>
</template>

<script setup>
import { ref, computed } from 'vue'

const showTooltip = ref(false)

// Props
const props = defineProps({
    text: {
        type: String,
        required: true
    },
    position: {
        type: String,
        default: 'top'
    }
})

const tooltipClass = computed(() => {
    switch (props.position) {
        case 'top':
            return 'tooltip-top'
        case 'bottom':
            return 'tooltip-bottom'
        case 'left':
            return 'tooltip-left'
        case 'right':
            return 'tooltip-right'
        default:
            return 'tooltip-top'
    }
})

const tooltipStyle = ref({
    width: 'max-content'
})
</script>

<style scoped>
.tooltip-top {
    @apply bottom-full left-1/2 -translate-x-1/2 -translate-y-[5px] transform;
}

.tooltip-bottom {
    @apply left-1/2 top-full -translate-x-1/2 translate-y-[5px] transform;
}

.tooltip-left {
    @apply right-full top-1/2 -translate-x-[5px] -translate-y-1/2 transform;
}

.tooltip-right {
    @apply left-full top-1/2 -translate-y-1/2 translate-x-[5px] transform;
}

/* Arrows */
.tooltip-top::before,
.tooltip-bottom::before,
.tooltip-left::before,
.tooltip-right::before {
    @apply absolute border-solid content-[''];
}

.tooltip-top::before {
    @apply -bottom-[5px] left-1/2 -translate-x-1/2 transform border-b-0 border-l-[5px] border-r-[5px] border-t-[5px] border-b-transparent border-l-transparent border-r-transparent border-t-skin-neutral-9;
}

.tooltip-bottom::before {
    @apply -top-[5px] left-1/2 -translate-x-1/2 transform border-b-[5px] border-l-[5px] border-r-[5px] border-t-0 border-b-skin-neutral-9 border-l-transparent border-r-transparent border-t-transparent;
}

.tooltip-left::before {
    @apply -right-[5px] top-1/2 -translate-y-1/2 transform border-b-[5px] border-l-[5px] border-r-0 border-t-[5px] border-b-transparent border-l-skin-neutral-9 border-r-transparent border-t-transparent;
}

.tooltip-right::before {
    @apply -left-[5px] top-1/2 -translate-y-1/2 transform border-b-[5px] border-l-0 border-r-[5px] border-t-[5px] border-b-transparent border-l-transparent border-r-skin-neutral-9 border-t-transparent;
}

/* Tooltip Transition */
.fade-enter-active,
.fade-leave-active {
    @apply transition-opacity duration-500;
}

.fade-enter-from,
.fade-leave-to {
    @apply opacity-0;
}
</style>
