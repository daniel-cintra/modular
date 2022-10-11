import { ref } from 'vue'

export default function useFormContext() {
    const isCreate = ref()

    isCreate.value = route().current().includes('.create')

    return { isCreate }
}
