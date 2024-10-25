<template>
    <div ref="wrapperRef" class="relative w-48">
        <AppButton
            class="mt-1 flex w-full justify-between rounded-md border-0 bg-skin-neutral-1 px-3 py-2 align-middle text-skin-neutral-12 placeholder-skin-neutral-9 shadow-sm ring-1 ring-inset ring-skin-neutral-7 focus:ring-2 focus:ring-inset focus:ring-skin-neutral-7 sm:text-sm sm:leading-6"
            aria-haspopup="true"
            :aria-expanded="isOpen"
            @click="toggleState"
        >
            <span class="mr-2 inline-block"> {{ comboLabelText }} </span>
            <span>
                <i
                    v-show="modelValue"
                    class="ri-close-circle-line mr-2 inline-block hover:text-skin-neutral-9"
                    @click.prevent="clearSelection"
                ></i>
                <i class="ri-arrow-down-line hover:text-skin-neutral-9"></i>
            </span>
        </AppButton>

        <transition name="slide-fade">
            <div v-show="isOpen" class="absolute z-50 mt-1 w-full">
                <div v-show="useSearch" class="bg-skin-neutral-1 p-1 shadow">
                    <!-- search input -->
                    <label :for="getElementId()" class="sr-only">Search</label>
                    <div class="relative">
                        <div
                            class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3"
                        >
                            <i class="ri-search-line" aria-hidden="true"></i>
                        </div>
                        <AppInputText
                            :id="getElementId()"
                            ref="searchInputRef"
                            v-model="searchOptionText"
                            role="searchbox"
                            aria-autocomplete="list"
                            type="text"
                            class="pl-10"
                            :placeholder="searchPlaceholder"
                            @keypress.enter="validateOptionHighlighted"
                            @keydown="handleArrowKeys"
                            @keydown.esc="toggleState"
                        />
                    </div>
                </div>

                <!-- combo options -->
                <ul class="bg-skin-neutral-1 p-1 shadow" role="listbox">
                    <li
                        v-for="(option, index) in filteredOptions"
                        :key="option.value"
                        role="option"
                        :aria-selected="index === highlightedIndex"
                        class="block px-4 py-2 text-sm hover:cursor-pointer hover:bg-skin-neutral-3 hover:text-skin-neutral-12"
                        :class="{
                            'bg-skin-neutral-3 text-skin-neutral-12':
                                index === highlightedIndex
                        }"
                        @click="updateModelValue(option)"
                    >
                        {{ option.label }}
                    </li>
                </ul>
            </div>
        </transition>
    </div>
</template>

<script setup>
import { ref, computed, onMounted, watch } from 'vue'
import slug from '@resources/js/Utils/slug.js'
import useClickOutside from '@resources/js/Composables/useClickOutside'

const props = defineProps({
    modelValue: {
        type: [Object, Number, String, null],
        required: true
    },
    comboLabel: {
        type: String,
        default: 'Dropdown search'
    },
    useSearch: {
        type: Boolean,
        default: true
    },
    searchPlaceholder: {
        type: String,
        default: 'Search'
    },
    options: {
        type: Array,
        default: () => []
    }
})

const wrapperRef = ref(null)

const { isClickOutside } = useClickOutside(wrapperRef)

watch(isClickOutside, (val) => {
    if (val) {
        isOpen.value = false
    }
})

onMounted(() => {
    isOpen.value && (highlightedIndex.value = 0)
})

const getElementId = () => {
    return slug(props.comboLabel)
}

const emit = defineEmits(['update:modelValue'])

const isOpen = ref(false)

const searchInputRef = ref(null)
const toggleState = () => {
    isOpen.value = !isOpen.value

    highlightedIndex.value = 0

    window.setTimeout(() => {
        if (isOpen.value) {
            searchOptionText.value = ''
            searchInputRef.value.focusInput()
        }
    }, 100)
}

const updateModelValue = (option) => {
    emit('update:modelValue', option)
    toggleState()
}

const searchOptionText = ref('')

const filteredOptions = computed(() => {
    if (searchOptionText.value) {
        return props.options.filter((option) =>
            option.label
                .toLowerCase()
                .includes(searchOptionText.value.toLowerCase())
        )
    } else {
        return props.options
    }
})

const validateOptionHighlighted = () => {
    if (filteredOptions.value[highlightedIndex.value]) {
        updateModelValue(filteredOptions.value[highlightedIndex.value])
    }
}

const highlightedIndex = ref(0)

const handleArrowKeys = (event) => {
    switch (event.key) {
        case 'ArrowUp':
            if (highlightedIndex.value > 0) {
                highlightedIndex.value--
            }
            break
        case 'ArrowDown':
            if (highlightedIndex.value < filteredOptions.value.length - 1) {
                highlightedIndex.value++
            }
            break
        default:
            break
    }
}

const clearSelection = (e) => {
    e.stopPropagation()
    highlightedIndex.value = 0
    emit('update:modelValue', null)
    isOpen.value = false
}

const comboLabelText = computed(() => {
    if (props.modelValue) {
        return props.modelValue.label
    } else {
        return props.comboLabel
    }
})
</script>

<style scoped>
.slide-fade-enter-active,
.slide-fade-leave-active {
    @apply transition-all duration-200 ease-in;
}
.slide-fade-enter-from,
.slide-fade-leave-to {
    @apply -translate-y-2 opacity-0;
}
</style>
