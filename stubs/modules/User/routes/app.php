<?php

use Illuminate\Support\Facades\Route;
use Modules\User\Http\Controllers\UserController;

Route::get('user', [
    UserController::class, 'index',
])->name('user.index');

Route::get('user/create', [
    UserController::class, 'create',
])->name('user.create');

Route::get('user/{id}/edit', [
    UserController::class, 'edit',
])->name('user.edit');

Route::post('user', [
    UserController::class, 'store',
])->name('user.store');

Route::put('user/{id}', [
    UserController::class, 'update',
])->name('user.update');

Route::delete('user/{id}', [
    UserController::class, 'destroy',
])->name('user.destroy');
