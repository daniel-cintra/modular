<?php

use Modular\Modular\User\Models\User;

it('can create a user', function () {
    $user = User::factory()->create();
    $this->assertInstanceOf(User::class, $user);

    $this->assertDatabaseCount('users', 1);
    $this->assertDatabaseHas('users', [
        'id' => $user->id,
        'name' => $user->name,
        'email' => $user->email,
    ]);
});
