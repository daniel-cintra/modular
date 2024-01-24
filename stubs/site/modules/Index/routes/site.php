<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [
    'uses' => 'IndexController@index',
])->name('index.index');
