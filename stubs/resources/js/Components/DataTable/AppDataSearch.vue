<template>
    <div class="rounded-tl rounded-tr bg-skin-neutral-3 pb-4 pl-3 pt-3">
        <label for="search" class="sr-only">Search</label>
        <div class="flex items-center pr-4 align-middle">
            <div class="pointer-events-none absolute flex items-center pl-3">
                <i class="ri-search-line"></i>
            </div>
            <AppInputText
                id="search"
                v-model="searchTerm"
                :placeholder="__('Search')"
                name="search"
                class="w-full py-2 pl-9 md:w-1/2"
            ></AppInputText>

            <AppButton
                v-if="searchTerm"
                class="btn ml-2 border border-skin-neutral-8 bg-skin-neutral-5 hover:bg-skin-neutral-8"
                @click="clearSearch"
            >
                <i class="ri-close-line"></i>
            </AppButton>
        </div>
    </div>
</template>

<script setup>
import useDataSearch from '@/Composables/useDataSearch'

const props = defineProps({
    url: {
        type: String,
        required: true
    },
    fieldsToSearch: {
        type: String,
        required: true
    },
    additionalParams: {
        type: Object,
        default: () => {}
    }
})

const { searchTerm, clearSearch } = useDataSearch(
    props.url,
    props.fieldsToSearch,
    props.additionalParams
)
</script>
