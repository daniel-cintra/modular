import useFormContext from '@/Composables/useFormContext'
import { computed } from 'vue'
import { inject } from 'vue'

export default function useTitle(sectionName) {
    const translate = inject('translate')

    const { isCreate, isEdit } = useFormContext()

    const title = computed(() => {
        let prefix = ''

        if (isCreate.value) {
            prefix = 'Create'
        }

        if (isEdit.value) {
            prefix = 'Edit'
        }

        // let prefix = isCreate.value ? 'Create' : 'Edit'
        prefix = translate(prefix)
        return prefix + ' ' + translate(sectionName)
    })

    return { title }
}
