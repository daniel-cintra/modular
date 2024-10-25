<template>
    <transition name="fade">
        <div v-show="isModalOpen" :class="backdropClasses" @click="hideModal">
            <div
                class="mx-auto my-auto min-w-[360px] rounded-lg bg-skin-neutral-2 p-4 text-skin-neutral-11 lg:w-1/3"
                :class="[placementClass, 'absolute']"
                @click.stop
            >
                <!-- Modal Header Slot -->
                <slot v-if="$slots.header" name="header"> </slot>

                <!-- Modal Main Content Slot -->
                <slot v-if="$slots.body" name="body"> </slot>

                <!-- Modal Footer Slot -->
                <slot v-if="$slots.footer" name="footer"></slot>
            </div>
        </div>
    </transition>
</template>

<script setup>
import { computed } from 'vue'

const props = defineProps({
    backdropClasses: {
        type: String,
        default: 'bg-skin-neutral-9 bg-opacity-75 fixed inset-0 z-50'
    },
    placement: {
        type: String,
        default: 'center'
    },
    isModalOpen: {
        type: Boolean,
        default: false
    }
})

const emit = defineEmits(['modal:toggle'])

const placementClass = computed(() => {
    switch (props.placement) {
        case 'center':
            return 'absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2'
        case 'top':
            return 'absolute top-0 left-1/2 transform -translate-x-1/2'
        case 'bottom':
            return 'absolute bottom-0 left-1/2 transform -translate-x-1/2'
        case 'left':
            return 'absolute top-1/2 left-0 transform -translate-y-1/2'
        case 'right':
            return 'absolute top-1/2 right-0 transform -translate-y-1/2'
        case 'top-left':
            return 'absolute top-0 left-0'
        case 'top-right':
            return 'absolute top-0 right-0'
        case 'bottom-left':
            return 'absolute bottom-0 left-0'
        case 'bottom-right':
            return 'absolute bottom-0 right-0'
        default:
            return ''
    }
})

function hideModal() {
    emit('modal:toggle')
}
</script>

<style scoped>
/* Fade Transition */
.fade-enter-active,
.fade-leave-active {
    @apply transition-opacity duration-300 ease-out;
}
.fade-enter-from,
.fade-leave-to {
    @apply opacity-0;
}
</style>
