<?php

namespace Modules\Acl\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Role;

class AclRoleSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        Role::truncate();

        Role::create([
            'name' => 'root',
            'guard_name' => 'user',
        ]);

        Schema::enableForeignKeyConstraints();
    }
}
