<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
use Modules\Support\Traits\UpdateOrder;
use Tests\TestCase;

uses(TestCase::class, RefreshDatabase::class, UpdateOrder::class);

beforeEach(function () {
    Schema::create('items', function (Blueprint $table) {
        $table->id();
        $table->string('name')->nullable();
        $table->unsignedTinyInteger('order')->nullable();
        $table->timestamps();
    });
});

it('can update the order of the model items', function () {
    $model = new class extends Model
    {
        use UpdateOrder;

        protected $table = 'items';

        protected $guarded = [];
    };

    $item1 = $model->create(['name' => 'Item 1', 'order' => 0]);
    $item2 = $model->create(['name' => 'Item 2', 'order' => 1]);

    $newOrder = [
        ['id' => $item2->id],
        ['id' => $item1->id],
    ];

    $model->updateOrder($newOrder);

    $this->assertEquals(0, $model->find($item2->id)->order);
    $this->assertEquals(1, $model->find($item1->id)->order);
});
