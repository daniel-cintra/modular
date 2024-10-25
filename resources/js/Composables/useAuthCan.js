import { usePage } from '@inertiajs/vue3'

export default function useAuthCan() {
    const auth = usePage().props.auth

    const can = (permission) => {
        if (auth && auth.isRootUser) {
            return true
        }

        return auth && auth.permissions.includes(permission)
    }

    return { can }
}
