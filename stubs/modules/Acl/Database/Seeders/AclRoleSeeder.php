<?php

namespace Modules\Acl\Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class AclRoleSeeder extends Seeder
{
    public function run(): void
    {
        Role::truncate();

        Role::create([
            'name' => 'root',
            'guard_name' => 'user',
        ]);
    }
}
