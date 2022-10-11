import { computed } from 'vue'
import { usePage } from '@inertiajs/inertia-vue3'

export default function useFormErrors() {
    const errors = computed(() => usePage().props.value.errors)

    const errorsFields = computed(() => Object.keys(errors.value))

    return { errors, errorsFields }
}
