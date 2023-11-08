<template>
    <AppModal :is-modal-open="isModalOpen" @modal:toggle="toggleModal">
        <!-- Modal header -->
        <template #header>
            <div
                class="flex items-center justify-between rounded-t border-b border-skin-neutral-6 p-5"
            >
                <h3 class="text-xl font-semibold lg:text-2xl">
                    {{ __('Confirmation') }}
                </h3>
                <AppButton class="btn btn-neutral btn-icon" @click="closeModal">
                    <i class="ri-close-line h-5 w-5"></i>
                </AppButton>
            </div>
        </template>

        <!-- Modal body -->
        <template #body>
            <div class="space-y-6 p-5">
                <p class="text-base leading-relaxed">
                    {{ __('Are you sure you want to proceed?') }}
                </p>
            </div>
        </template>

        <!-- Modal footer -->
        <template #footer>
            <div
                class="flex items-center justify-end space-x-2 rounded-b border-t border-skin-neutral-6 p-5"
            >
                <AppButton class="btn btn-neutral mr-3" @click="closeModal">
                    {{ __('No') }}
                </AppButton>

                <AppButton class="btn btn-destructive" @click="deleteItem()">
                    {{ __('Yes') }}
                </AppButton>
            </div>
        </template>
    </AppModal>
</template>

<script setup>
import { ref } from 'vue'
import { router } from '@inertiajs/vue3'

const isModalOpen = ref(false)
const deleteItemRoute = ref(null)

const toggleModal = () => {
    isModalOpen.value = !isModalOpen.value
}

const openModal = (deleteRoute) => {
    deleteItemRoute.value = deleteRoute
    isModalOpen.value = true
}

const closeModal = () => {
    isModalOpen.value = false
}

const deleteItem = () => {
    isModalOpen.value = false
    router.visit(deleteItemRoute.value, {
        method: 'delete'
    })
}

defineExpose({
    openModal
})
</script>
