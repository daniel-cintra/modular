<template>
    <div class="rounded-tl rounded-tr bg-skin-neutral-3 pb-4 pl-3 pt-3">
        <label for="search" class="sr-only">Search</label>
        <div class="flex items-center align-middle">
            <div class="pointer-events-none absolute flex items-center pl-3">
                <i class="ri-search-line"></i>
            </div>
            <AppInputText
                id="search"
                v-model="searchTerm"
                :placeholder="__('Search')"
                name="search"
                class="!w-1/2 py-2 pl-9"
            ></AppInputText>

            <AppButton
                v-if="searchTerm"
                class="btn btn-secondary btn-icon ml-2 border border-skin-primary-6"
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
