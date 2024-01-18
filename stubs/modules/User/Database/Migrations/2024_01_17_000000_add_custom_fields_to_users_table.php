<?php

namespace Modules\User\Database\Migrations;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('profile_type')->after('remember_token')->nullable();
            $table->unsignedBigInteger('profile_id')->after('profile_type')->nullable();
            $table->timestamp('deleted_at')->nullable()->after('updated_at');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('profile_type');
            $table->dropColumn('profile_id');
            $table->dropColumn('deleted_at');
        });
    }
};
