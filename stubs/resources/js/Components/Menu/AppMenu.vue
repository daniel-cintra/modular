<template>
    <div>
        <li class="mb-2 block">
            <div class="rounded-tl rounded-tr">
                <label for="search" class="sr-only">Search</label>
                <div class="flex items-center align-middle">
                    <div
                        class="pointer-events-none absolute flex items-center pl-3"
                    >
                        <i class="ri-search-line"></i>
                    </div>
                    <AppInputText
                        id="search"
                        v-model="searchTerm"
                        :placeholder="__('Search...')"
                        class="w-full pl-9"
                    ></AppInputText>

                    <AppButton
                        v-if="searchTerm"
                        class="btn ml-1 border border-skin-neutral-8 bg-skin-neutral-5 hover:bg-skin-neutral-8"
                        @click="searchTerm = ''"
                    >
                        <i class="ri-close-line"></i>
                    </AppButton>
                </div>
            </div>
        </li>

        <ul v-for="(item, index) in filteredItems" :key="index">
            <AppMenuSection :item="item" />
        </ul>
    </div>
</template>

<script setup>
import { ref } from 'vue'
import { computed } from 'vue'

const props = defineProps({
    items: {
        type: Array,
        default: () => []
    }
})

const searchTerm = ref('')

// Computed property to filter items based on search term
const filteredItems = computed(() => {
    if (!searchTerm.value) return props.items
    const searchFilter = (item) => {
        // Convert search term to lowercase for case-insensitive matching
        const term = searchTerm.value.toLowerCase()

        // Check if the label or any child item contains the search term
        const matches = (i) =>
            i.label?.toLowerCase().includes(term) ||
            (i.children && i.children.some(matches)) // Recursively check children

        return matches(item)
    }

    // Filter items recursively
    return props.items.filter(searchFilter)
})
</script>
