<?php

use Illuminate\Database\Seeder;
use Modules\Acl\Database\Seeders\AclModelHasRolesSeeder;
use Modules\Acl\Database\Seeders\AclPermissionSeeder;
use Modules\Acl\Database\Seeders\AclRoleSeeder;
use Modules\User\Database\Seeders\UserSeeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            AclRoleSeeder::class,
            AclPermissionSeeder::class,
            AclModelHasRolesSeeder::class,
        ]);
    }
}
