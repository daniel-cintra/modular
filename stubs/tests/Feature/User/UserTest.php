<?php

use Inertia\Testing\AssertableInertia as Assert;
use Modules\User\Models\User;

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->loggedRequest = $this->actingAs($this->user);
});

test('user list can be rendered', function () {
    $response = $this->loggedRequest->get('/user');

    $response->assertStatus(200);

    $response->assertInertia(
        fn (Assert $page) => $page
            ->component('User/UserIndex')
            ->has(
                'users.data',
                1,
                fn (Assert $page) => $page
                    ->where('id', $this->user->id)
                    ->where('name', $this->user->name)
                    ->where('email', $this->user->email)
                    ->where('created_at', $this->user->created_at->format('d/m/Y H:i\h'))
            )
    );
});

test('user can be created', function () {
    $response = $this->loggedRequest->post('/user', [
        'name' => 'New Name',
        'email' => 'new@email.com',
        'password' => 'password',
    ]);

    $users = User::all();

    $response->assertRedirect('/user');
    $this->assertCount(2, $users);
    $this->assertEquals('New Name', $users->last()->name);
});

test('user edit can be rendered', function () {
    $response = $this->loggedRequest->get('/user/'.$this->user->id.'/edit');

    $response->assertStatus(200);

    $response->assertInertia(
        fn (Assert $page) => $page
            ->component('User/UserForm')
            ->has(
                'user',
                fn (Assert $page) => $page
                    ->where('id', $this->user->id)
                    ->where('name', $this->user->name)
                    ->where('email', $this->user->email)
            )
    );
});

test('user can be updated', function () {
    $response = $this->loggedRequest->put('/user/'.$this->user->id, [
        'name' => 'New Name',
        'email' => 'new@email.com',
        'password' => 'password',
    ]);

    $response->assertRedirect('/user');

    $redirectResponse = $this->loggedRequest->get('/user');
    $redirectResponse->assertInertia(
        fn (Assert $page) => $page
            ->component('User/UserIndex')
            ->has(
                'users.data',
                1,
                fn (Assert $page) => $page
                    ->where('id', $this->user->id)
                    ->where('name', 'New Name')
                    ->where('email', 'new@email.com')
                    ->where('created_at', $this->user->created_at->format('d/m/Y H:i\h'))
            )
    );
});

test('user can be deleted', function () {
    $response = $this->loggedRequest->delete('/user/'.$this->user->id);

    $response->assertRedirect('/user');

    $this->assertCount(0, User::all());
});
