import { computed } from 'vue'
import { usePage } from '@inertiajs/vue3'

export default function useFormErrors() {
    const errors = computed(() => usePage().props.errors)

    const errorsFields = computed(() => Object.keys(errors.value))

    return { errors, errorsFields }
}
