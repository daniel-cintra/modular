<template>
    <Head title="Modular"></Head>

    <AppSideBar
        ref="sidebarRef"
        :backdrop="showBackdrop"
        @sidebar:toggle="sidebarToggle"
    >
        <Link :href="route('dashboard.index')" class="mb-6 flex pl-2">
            <img
                src="@resources/images/logo.svg"
                class="w-40"
                alt="Modular Logo"
            />
        </Link>

        <AppMenu :items="items" />
    </AppSideBar>

    <main
        class="flex flex-1 flex-col pb-9"
        :class="{ 'md:pl-64': isSideBarOpen }"
    >
        <AppFlashMessage />
        <AppTopBar
            :class="{ 'ml-64': isSideBarOpen }"
            class="md:ml-0"
            @sidebar:toggle="sidebarToggle"
        />
        <div class="mx-8 2xl:mx-16">
            <slot></slot>
        </div>
    </main>
</template>

<script setup>
import { ref, onMounted, computed } from 'vue'
import { Head } from '@inertiajs/vue3'
import menu from '@/Configs/menu'

const isSideBarOpen = ref(true)
const sidebarRef = ref()

const width = window.innerWidth

onMounted(() => {
    if (width <= 1024) {
        sidebarToggle()
    }
})

const sidebarToggle = () => {
    isSideBarOpen.value = !isSideBarOpen.value
    sidebarRef.value.toggle()
}

const showBackdrop = computed(() => {
    return width <= 1024 ? true : false
})

const items = menu.items
</script>
