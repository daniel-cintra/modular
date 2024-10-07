import { ref } from 'vue'

export default function useFormContext() {
    const isCreate = ref()
    const isEdit = ref()

    isCreate.value = route().current().includes('.create')
    isEdit.value = route().current().includes('.edit')

    return { isCreate, isEdit }
}
