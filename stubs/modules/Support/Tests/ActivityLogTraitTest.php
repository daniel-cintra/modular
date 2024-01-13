<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
use Modules\Support\Traits\ActivityLog;
use Tests\TestCase;

uses(TestCase::class, RefreshDatabase::class, ActivityLog::class);

beforeEach(function () {
    Schema::create('items', function (Blueprint $table) {
        $table->id();
        $table->string('name')->nullable();
        $table->timestamps();
    });
});

it('logs the activity for the model', function () {
    $model = new class extends Model
    {
        use ActivityLog;

        protected $table = 'items';

        protected $guarded = [];
    };

    $item1 = $model->create(['name' => 'Item 1']);

    $item1->delete();

    $this->assertDatabaseHas('activity_log', [
        'subject_id' => $item1->id,
        'subject_type' => get_class($item1),
        'description' => 'deleted',
    ]);
});
