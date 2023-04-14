import { usePage } from '@inertiajs/vue3'

export default function useAuthCan() {
    const can = (permission) => {
        const auth = usePage().props.auth

        if (auth && auth.isRootUser) {
            return true
        }

        return auth && auth.permissions.includes(permission)
    }

    return { can }
}
