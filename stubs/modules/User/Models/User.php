<?php

namespace Modules\User\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Database\Factories\UserFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Modules\AdminAuth\Notifications\ResetPassword;
use Modules\Support\Traits\Searchable;
use Modules\Support\Traits\ActivityLog;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles, ActivityLog, Searchable;

    protected static function newFactory()
    {
        return UserFactory::new();
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Overwrites the method from Authenticatable/CanResetPasswordContract.
     *
     * @param string $token
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }
}
