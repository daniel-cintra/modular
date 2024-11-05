<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Modules\User\Models\User;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

use function Pest\Laravel\artisan;

uses(TestCase::class, RefreshDatabase::class);

beforeEach(function () {
    Role::create(['name' => 'root']);
});

function validUserData(): array
{
    return [
        'name' => 'John Doe',
        'email' => 'john@example.com',
        'password' => 'Password123!',
        'role' => 'root',
    ];
}

it('creates a user with valid input', function () {
    $input = validUserData();

    artisan('modular:create-user')
        ->expectsQuestion('Please enter the user\'s name:', $input['name'])
        ->expectsQuestion('Please enter the user\'s email:', $input['email'])
        ->expectsQuestion('Please enter the user\'s password:', $input['password'])
        ->expectsQuestion('Please select the user\'s role:', $input['role'])
        ->expectsOutput('User created successfully.')
        ->expectsOutput('You can now log in with the following credentials:')
        ->expectsTable(
            ['Field', 'Value'],
            [
                ['URL', config('app.url')],
                ['Email', $input['email']],
                ['Password', $input['password']],
            ]
        )
        ->assertSuccessful()
        ->run();

    $this->assertDatabaseHas('users', [
        'name' => $input['name'],
        'email' => $input['email'],
    ]);

    $user = User::where('email', $input['email'])->first();

    expect($user)->toBeInstanceOf(User::class)
        ->and($user->name)->toBe($input['name'])
        ->and($user->email)->toBe($input['email'])
        ->and(Hash::check($input['password'], $user->password))->toBeTrue()
        ->and($user->roles)->toHaveCount(1)
        ->and($user->hasRole('root'))->toBeTrue();
});

it('validates user name', function () {
    artisan('modular:create-user')
        ->expectsQuestion('Please enter the user\'s name:', '')
        ->assertExitCode(1);

    expect(User::count())->toBe(0);
});

it('validates email format', function () {
    artisan('modular:create-user')
        ->expectsQuestion('Please enter the user\'s name:', 'John Doe')
        ->expectsQuestion('Please enter the user\'s email:', 'invalid-email')
        ->assertExitCode(1);

    expect(User::count())->toBe(0);
});

it('prevents duplicate emails', function () {
    User::factory()->create(['email' => 'john@example.com']);

    artisan('modular:create-user')
        ->expectsQuestion('Please enter the user\'s name:', 'John Doe')
        ->expectsQuestion('Please enter the user\'s email:', 'john@example.com') // Duplicate email
        ->assertExitCode(1);

    expect(User::count())->toBe(1);
});

it('validates password strength', function () {
    artisan('modular:create-user')
        ->expectsQuestion('Please enter the user\'s name:', 'John Doe')
        ->expectsQuestion('Please enter the user\'s email:', 'john@example.com')
        ->expectsQuestion('Please enter the user\'s password:', '123') // Too weak password
        ->assertExitCode(1);

    expect(User::count())->toBe(0);
});
