<?php

namespace Modular\Modular\Acl\Services;

use Illuminate\Support\Collection;
use Modular\Modular\User\Models\User;

class GetUserPermissions
{
    public function run(int $userId): array
    {
        $user = User::with(['permissions' => function ($query) {
            $query->get(['id', 'name']);
        }])->findOrFail($userId);

        // ray($user->permissions);

        //if has direct permissions use it
        if ($user->permissions->count()) {
            return $this->mapPermissions($user->permissions);
        //get the permissions via roles
        } else {
            return $this->mapPermissions($user->getAllPermissions());
        }
    }

    private function mapPermissions(Collection $permissions): array
    {
        return $permissions->map(fn ($permission) => [
            'id' => $permission->id,
            'name' => $permission->name,
        ])->toArray();
    }
}
