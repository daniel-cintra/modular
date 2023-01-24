<?php

namespace Modular\Modular;

class SupportServiceProvider extends BaseServiceProvider
{
    /**
     * This namespace is applied to the controller routes in your routes file.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'Modular\Modular\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     */
    public function boot()
    {
        include __DIR__.'/helpers.php';
        include __DIR__.'/Validators/required_editor.php';
        parent::boot();
    }
}
