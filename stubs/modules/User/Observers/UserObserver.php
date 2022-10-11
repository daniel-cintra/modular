<?php

namespace Modules\User\Observers;

use Modules\User\Models\User;
use Illuminate\Support\Facades\Hash;

class UserObserver
{
    public function saving(User $user)
    {
        if (request()->filled('password')) {
            $user->password = Hash::make(request('password'));
        }
    }
}
