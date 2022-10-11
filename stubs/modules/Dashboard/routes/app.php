<?php

use Illuminate\Support\Facades\Route;

Route::get('/dashboard', [
    'uses' => 'DashboardController@index',
])->name('dashboard.index');
