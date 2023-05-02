<template>
    <Head title="Modular"></Head>
    <AppSideBar
        ref="appSideBarRef"
        :is-side-bar-open="isSideBarOpen"
        @update-status="toggleSideBar"
    />
    <main class="flex flex-1 flex-col" :class="{ 'md:pl-64': isSideBarOpen }">
        <AppToast />
        <ConfirmDialog></ConfirmDialog>
        <AppTopBar @toggle-sidebar="toggleSideBar" />
        <div
            class="md:opacity-100 2xl:mx-16"
            :class="{ 'opacity-25': isSideBarOpen }"
        >
            <slot></slot>
        </div>
    </main>
</template>

<script setup>
import { ref } from 'vue'
import { useWindowSize, useResizeObserver, onClickOutside } from '@vueuse/core'
import { Head } from '@inertiajs/vue3'

const { width } = useWindowSize()

const isSideBarOpen = ref(true)

if (width.value <= 992) {
    isSideBarOpen.value = false
}

const appSideBarRef = ref(null)

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

    if (width.value <= 640) {
        onClickOutside(appSideBarRef, (event) => {
            if (isSideBarOpen.value) {
                isSideBarOpen.value = false
            }
        })
    }
}
</script>
