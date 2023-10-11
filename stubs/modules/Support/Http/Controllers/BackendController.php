<?php

namespace Modules\Support\Http\Controllers;

class BackendController extends AppController
{
    public function __construct()
    {
        $this->middleware('auth.user');
    }
}
