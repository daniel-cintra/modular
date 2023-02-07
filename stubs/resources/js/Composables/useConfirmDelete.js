import { router } from '@inertiajs/vue3'
import { useConfirm } from 'primevue/useconfirm'
import { inject } from 'vue'

export default function useConfirmDelete() {
    const translate = inject('translate')
    const confirm = useConfirm()

    function confirmDelete(routePath, item) {
        const acceptCallback = () => {
            router.visit(route(routePath, item.id), {
                method: 'delete'
            })
        }

        confirm.require({
            header: translate('Confirmation'),
            message: translate('Are you sure you want to proceed?'),
            icon: 'pi pi-exclamation-triangle',
            accept: acceptCallback,
            acceptLabel: translate('Yes'),
            rejectLabel: translate('No')
        })
    }

    return { confirmDelete }
}
