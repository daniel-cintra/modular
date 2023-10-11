<?php

namespace Modules\User\Observers;

use Illuminate\Support\Facades\Hash;
use Modules\User\Models\User;

class UserObserver
{
    public function saving(User $user)
    {
        if (request()->filled('password')) {
            $user->password = Hash::make(request('password'));
        }
    }

    public function created(User $user)
    {
        if (! $user->profile_type) {
            $user->profile_type = 'user';
            $user->profile_id = $user->id;
            $user->save();
        }
    }
}
