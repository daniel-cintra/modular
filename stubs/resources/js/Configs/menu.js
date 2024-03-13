import { ZiggyVue } from '/vendor/tightenco/ziggy/dist/index.esm.js'

export default {
    // main navigation - side menu
    items: [
        {
            label: 'Dashboard',
            permission: 'Main Menu: Dashboard',
            icon: 'ri-dashboard-line',
            link: route('dashboard.index')
        },

        {
            label: 'Access Control List',
            permission: 'Main Menu: Access Control List',
            children: [
                {
                    label: 'Users',
                    permission: 'Main Menu: Access Control List: Users - List',
                    icon: 'ri-user-line',
                    link: route('user.index')
                },
                {
                    label: 'Permissions',
                    permission:
                        'Main Menu: Access Control List: Permissions - List',
                    icon: 'ri-shield-keyhole-line',
                    link: route('aclPermission.index')
                },
                {
                    label: 'Roles',
                    permission: 'Main Menu: Access Control List: Roles - List',
                    icon: 'ri-account-box-line',
                    link: route('aclRole.index')
                }
            ]
        }
    ]
}
