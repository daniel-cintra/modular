<?php

namespace Modules\Acl\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;

class AclPermissionSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        Permission::truncate();

        $permissions = $this->getPermissions();

        foreach ($permissions as $permission) {
            Permission::create([
                'name' => $permission,
                'guard_name' => 'user',
            ]);
        }

        Schema::enableForeignKeyConstraints();
    }

    private function getPermissions(): array
    {
        return [
            //Main Menu
            'Dashboard',

            //Acl: Access Control List
            'Acl',
            'Acl: User - List',
            'Acl: Permission - List',
            'Acl: Role - List',

            //User/UserIndex.vue
            'Acl: User: Role - Edit',
            'Acl: User: Permission - Edit',
            'Acl: User - Create',
            'Acl: User - Edit',
            'Acl: User - Delete',

            //AclPermission/PermissionIndex.vue
            'Acl: Permission - Create',
            'Acl: Permission - Edit',
            'Acl: Permission - Delete',

            //AclRole/RoleIndex.vue
            'Acl: Role - Create',
            'Acl: Role - Edit',
            'Acl: Role - Delete',

            //AclRolePermission/RolePermissionForm.vue
            'Acl: Role: Permission - Edit',
        ];

    }
}
