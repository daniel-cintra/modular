import useFormContext from '@/Composables/useFormContext'
import { computed } from 'vue'

export default function useTitle(sectionName) {
    const { isCreate } = useFormContext()

    const title = computed(() => {
        const prefix = isCreate.value ? 'Create' : 'Edit'
        return `${prefix} ${sectionName}`
    })

    return { title }
}
