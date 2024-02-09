<?php

use Illuminate\Support\Facades\Route;
use Modules\Dashboard\Http\Controllers\DashboardController;

Route::get('/dashboard', [
    DashboardController::class, 'index',
])->name('dashboard.index');
