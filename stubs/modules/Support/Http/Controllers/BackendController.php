<?php

namespace Modules\Support\Http\Controllers;

use App\Http\Controllers\Controller;

class BackendController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.user');
    }
}
