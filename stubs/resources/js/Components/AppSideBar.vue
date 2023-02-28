<template>
    <Sidebar
        v-model:visible="sideBarVisible"
        :show-close-icon="false"
        :modal="showModal"
    >
        <aside aria-label="Sidebar">
            <div class="h-full overflow-y-auto py-5 px-3">
                <Link :href="route('dashboard.index')" class="mb-5 flex pl-2">
                    <img
                        src="@resources/images/logo.svg"
                        class="w-40"
                        alt="Modular Logo"
                    />
                </Link>

                <AppMenu :items="items" />
            </div>
        </aside>
    </Sidebar>
</template>
<script setup>
import { ref, computed } from 'vue'
import menu from '@/Configs/menu'

const props = defineProps({
    isSideBarOpen: {
        type: Boolean
    }
})

//necessary to clear console warning about computed read only
const sideBarVisible = computed({
    get() {
        return props.isSideBarOpen
    },
    set(newValue) {}
})

const showModal = ref(false)

const items = menu.items
</script>
