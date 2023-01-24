<template>
    <Toast position="top-right" />
</template>

<script setup>
import { ref, computed, watch } from 'vue'
import { usePage } from '@inertiajs/vue3'
import { useToast } from 'primevue/usetoast'

const flash = computed(() => usePage().props.flash)

const toastType = ref(null)
const toastMessage = ref(null)

const toast = useToast()

const openToast = () => {
    toast.add({
        severity: toastType.value,
        summary: 'Message',
        detail: toastMessage.value,
        life: 6000
    })
}

watch(flash, (newFlash) => {
    if (newFlash.success) {
        toastType.value = 'success'
        toastMessage.value = newFlash.success
        openToast()
    }

    if (newFlash.error) {
        toastType.value = 'error'
        toastMessage.value = newFlash.error
        openToast()
    }
})
</script>
