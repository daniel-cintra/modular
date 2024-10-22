export default {
    // main navigation - side menu
    items: [
        {
            label: 'Dashboard',
            permission: 'Dashboard',
            icon: 'ri-dashboard-line',
            link: route('dashboard.index')
        },

        {
            label: 'Access Control List',
            permission: 'Acl',
            children: [
                {
                    label: 'Users',
                    permission: 'Acl: User - List',
                    icon: 'ri-user-line',
                    link: route('user.index')
                },
                {
                    label: 'Permissions',
                    permission: 'Acl: Permission - List',
                    icon: 'ri-shield-keyhole-line',
                    link: route('aclPermission.index')
                },
                {
                    label: 'Roles',
                    permission: 'Acl: Role - List',
                    icon: 'ri-account-box-line',
                    link: route('aclRole.index')
                }
            ]
        }
    ]
}
