<?php

namespace Modular\Modular\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Modular\Modular\Modular
 */
class Modular extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Modular\Modular\Modular::class;
    }
}
