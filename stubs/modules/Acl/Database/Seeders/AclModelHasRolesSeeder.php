<?php

namespace Modules\Acl\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AclModelHasRolesSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        DB::table('model_has_roles')->truncate();

        //root
        DB::table('model_has_roles')->insert([
            'role_id' => 1,
            'model_type' => 'user',
            'model_id' => 1,
        ]);

        Schema::enableForeignKeyConstraints();
    }
}
