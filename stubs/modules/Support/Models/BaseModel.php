<?php

namespace Modules\Support\Models;

use Illuminate\Database\Eloquent\Model;

abstract class BaseModel extends Model
{
    protected $guarded = ['_method'];

    /**
     * The "booting" method of the model.
     */
    protected static function boot()
    {
        parent::boot();
    }
}
