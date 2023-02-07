import useFormContext from '@/Composables/useFormContext'
import { computed } from 'vue'
import { inject } from 'vue'

export default function useTitle(sectionName) {
    const translate = inject('translate')

    const { isCreate } = useFormContext()

    const title = computed(() => {
        const prefix = isCreate.value ? 'Create' : 'Edit'
        return translate(`${prefix} ${sectionName}`)
    })

    return { title }
}
