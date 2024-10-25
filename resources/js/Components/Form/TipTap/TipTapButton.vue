<template>
    <button
        :title="title"
        class="m-0 h-6 w-6 cursor-pointer overflow-visible break-words border-none bg-transparent bg-no-repeat p-0 text-center font-sans text-sm normal-case leading-5 text-skin-neutral-11 hover:rounded-sm hover:bg-skin-neutral-3 hover:text-skin-neutral-12"
    >
        <i
            class="text-centertext-sm m-0 cursor-pointer break-words bg-no-repeat p-0 not-italic leading-5"
            :class="icon"
        ></i>
    </button>
</template>

<script setup>
defineProps({
    title: {
        type: String,
        default: ''
    },
    icon: {
        type: String,
        default: ''
    }
})
</script>
