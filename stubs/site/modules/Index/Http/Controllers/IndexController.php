<?php

namespace Modules\Index\Http\Controllers;

use Modules\Support\Http\Controllers\SiteController;

class IndexController extends SiteController
{
    public function index()
    {
        return view('index::index');
    }
}
