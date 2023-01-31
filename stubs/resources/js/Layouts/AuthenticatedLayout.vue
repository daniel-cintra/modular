<template>
    <Head title="Modular"></Head>
    <AppSideBar
        :is-side-bar-open="isSideBarOpen"
        @update-status="toggleSideBar"
    />
    <main class="flex flex-1 flex-col" :class="{ 'md:pl-64': isSideBarOpen }">
        <AppToast />
        <ConfirmDialog></ConfirmDialog>
        <AppTopBar @toggle-sidebar="toggleSideBar" />
        <div class="2xl:mx-16">
            <slot></slot>
        </div>
    </main>
</template>

<script setup>
import { ref } from 'vue'
import { useWindowSize } from '@vueuse/core'
import { useResizeObserver } from '@vueuse/core'
import { Head } from '@inertiajs/vue3'

const { width } = useWindowSize()

const isSideBarOpen = ref(true)

if (width.value <= 992) {
    isSideBarOpen.value = false
}

useResizeObserver(document.body, (entries) => {
    const entry = entries[0]
    const { width } = entry.contentRect

    if (width <= 992) {
        isSideBarOpen.value = false
    } else if (width > 992) {
        isSideBarOpen.value = true
    }
})

const toggleSideBar = () => {
    isSideBarOpen.value = !isSideBarOpen.value
}
</script>
