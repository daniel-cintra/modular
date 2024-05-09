<template>
    <Head title="Modular"></Head>

    <AppSideBar
        ref="sidebarRef"
        :backdrop="isMobile"
        :body-scrolling="!isMobile"
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
            <transition name="fade" mode="out-in">
                <!-- eslint-disable-next-line vue/require-toggle-inside-transition -->
                <div :key="page.props.ziggy.location">
                    <slot></slot>
                </div>
            </transition>
        </div>
    </main>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { Head, usePage } from '@inertiajs/vue3'
import useIsMobile from '@/Composables/useIsMobile'
import menu from '@/Configs/menu'

const page = usePage()

const isSideBarOpen = ref(true)
const sidebarRef = ref()

const { isMobile } = useIsMobile()

onMounted(() => {
    if (isMobile.value) {
        sidebarToggle()
    }
})

const sidebarToggle = () => {
    isSideBarOpen.value = !isSideBarOpen.value
    sidebarRef.value.toggle()
}

const items = menu.items
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
