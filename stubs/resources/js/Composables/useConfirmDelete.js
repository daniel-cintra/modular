import { router } from '@inertiajs/vue3'
import { useConfirm } from 'primevue/useconfirm'

export default function useConfirmDelete() {
    const confirm = useConfirm()

    function confirmDelete(routePath, item) {
        const acceptCallback = () => {
            router.visit(route(routePath, item.id), {
                method: 'delete'
            })
        }

        confirm.require({
            message: 'Are you sure you want to proceed?',
            header: 'Confirmation',
            icon: 'pi pi-exclamation-triangle',
            accept: acceptCallback
        })
    }

    return { confirmDelete }
}
