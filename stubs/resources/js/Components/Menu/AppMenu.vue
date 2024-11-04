<template>
    <div v-if="showInputSearch" class="mb-3 block">
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
    </div>

    <ul v-for="(item, index) in filteredItems" :key="index">
        <AppMenuSection :item="item" />
    </ul>
</template>

<script setup>
import { ref, computed } from 'vue'

const props = defineProps({
    items: {
        type: Array,
        default: () => []
    }
})

const showInputSearch = true

const searchTerm = ref('')

// Computed property to filter items based on search term
const filteredItems = computed(() => {
    if (!showInputSearch || !searchTerm.value) {
        return props.items
    }

    const term = searchTerm.value.toLowerCase()

    // Recursive function to filter items and their children
    const filterItems = (items) => {
        return items.reduce((acc, item) => {
            const isParentMatch = item.label.toLowerCase().includes(term)
            let filteredChildren = []

            if (item.children) {
                if (isParentMatch) {
                    // If parent matches, include all children
                    filteredChildren = item.children
                } else {
                    // Else, filter children based on search term
                    filteredChildren = filterItems(item.children)
                }
            }

            // Include the item if the parent matches or any of its children match
            if (
                isParentMatch ||
                (filteredChildren && filteredChildren.length)
            ) {
                acc.push({
                    ...item,
                    // If parent matches, include all children; else, include filtered children
                    children: isParentMatch ? item.children : filteredChildren
                })
            }

            return acc
        }, [])
    }

    return filterItems(props.items)
})
</script>
