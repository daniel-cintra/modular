<?php

namespace Modular\Modular\Http\Controllers;

class BackendController extends AppController
{
    public function __construct()
    {
        $this->middleware('auth.user');
    }
}
