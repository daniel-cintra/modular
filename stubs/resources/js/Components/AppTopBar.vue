<template>
    <div
        class="sticky top-0 z-10 flex h-16 flex-shrink-0 justify-between bg-skin-base-100 py-3 pl-3 pr-9 text-skin-base-content shadow"
    >
        <div class="flex items-center">
            <Button
                class="p-button-text p-button-sm flex items-center focus:shadow-none"
                @click="$emit('toggleSidebar')"
            >
                <i class="ri-menu-line text-skin-base-content"></i>
            </Button>

            <h1 class="flex items-center">{{ title }}</h1>
        </div>

        <div class="flex items-center">
            <a href="#" class="" @click="toggleTheme">
                <i :class="iconThemeClass"></i>
            </a>

            <Link class="ml-3" :href="route('adminAuth.logout')">
                <i class="ri-logout-circle-r-line"></i>
            </Link>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'

const props = defineProps({
    title: {
        type: String,
        default: ''
    }
})

const emit = defineEmits(['toggleSidebar'])

const iconThemeClass = ref('ri-sun-line')

onMounted(() => {
    if (localStorage.getItem('modular-theme') === 'dark-theme') {
        document.documentElement.classList.add('dark-theme')
        iconThemeClass.value = 'ri-sun-line'
    } else {
        document.documentElement.classList.remove('dark-theme')
        iconThemeClass.value = 'ri-moon-line'
    }
})

const toggleTheme = () => {
    if (document.documentElement.classList.contains('dark-theme')) {
        document.documentElement.classList.remove('dark-theme')
        iconThemeClass.value = 'ri-moon-line'
        localStorage.removeItem('modular-theme')
    } else {
        localStorage.setItem('modular-theme', 'dark-theme')
        document.documentElement.classList.add('dark-theme')
        iconThemeClass.value = 'ri-sun-line'
    }
}
</script>
