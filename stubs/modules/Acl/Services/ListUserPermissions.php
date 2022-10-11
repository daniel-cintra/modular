<?php

namespace Modules\Acl\Services;

use Modules\Acl\Services\GetUserPermissions;
use Illuminate\Support\Arr;

class ListUserPermissions
{
    public function run(int $userId): array
    {
        $userPermissions = (new GetUserPermissions)->run($userId);
        return Arr::pluck($userPermissions, 'name');
    }
}
