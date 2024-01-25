<?php

namespace Modules\Index;

use Modules\Support\BaseServiceProvider;

class IndexServiceProvider extends BaseServiceProvider
{
    protected $namespace = 'Modules\Index\Http\Controllers';

    public function boot()
    {
        parent::boot();

        $this->loadViewsFrom(__DIR__.'/views', 'index');
    }
}
