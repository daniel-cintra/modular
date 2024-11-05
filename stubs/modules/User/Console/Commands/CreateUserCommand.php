<?php

namespace Modules\User\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password as PasswordRule;
use Modules\User\Models\User;
use Spatie\Permission\Models\Role;

use function Laravel\Prompts\password;
use function Laravel\Prompts\select;
use function Laravel\Prompts\text;

class CreateUserCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'modular:create-user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates a new user with a specified role';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $userData = $this->collectUserData();
        $user = $this->createUser($userData);
        $this->displaySuccessMessage($userData);

        return self::SUCCESS;
    }

    private function collectUserData(): array
    {
        return [
            'name' => $this->promptName(),
            'email' => $this->promptEmail(),
            'password' => $this->promptPassword(),
            'role' => $this->promptRole(),
        ];
    }

    private function promptName(): string
    {
        return text(
            label: 'Please enter the user\'s name:',
            validate: fn (string $value): ?string => $this->validateInput(
                value: $value,
                rules: ['required', 'string', 'min:2', 'max:255']
            )
        );
    }

    private function promptEmail(): string
    {
        return text(
            label: 'Please enter the user\'s email:',
            validate: fn (string $value): ?string => $this->validateInput(
                value: $value,
                rules: ['required', 'email', 'max:255', 'unique:users,email']
            ),
            hint: 'This will be used to log in to the application.'
        );
    }

    private function promptPassword(): string
    {
        return password(
            label: 'Please enter the user\'s password:',
            validate: fn (string $value): ?string => $this->validateInput(
                value: $value,
                rules: ['required', PasswordRule::defaults()]
            )
        );
    }

    private function promptRole(): string
    {
        $roles = Role::pluck('name')->toArray();

        return select(
            label: 'Please select the user\'s role:',
            options: $roles
        );
    }

    private function validateInput(string $value, array $rules): ?string
    {
        $validator = Validator::make(['field' => $value], ['field' => $rules]);

        return $validator->fails()
            ? $validator->errors()->first('field')
            : null;
    }

    private function createUser(array $userData): User
    {
        $user = User::create([
            'name' => trim($userData['name']),
            'email' => trim($userData['email']),
            'password' => Hash::make(trim($userData['password'])),
        ]);

        $user->assignRole($userData['role']);

        return $user;
    }

    private function displaySuccessMessage(array $userData): void
    {
        $this->info('User created successfully.');
        $this->info('You can now log in with the following credentials:');
        $this->table(
            ['Field', 'Value'],
            [
                ['URL', config('app.url')],
                ['Email', trim($userData['email'])],
                ['Password', trim($userData['password'])],
            ]
        );
    }
}
