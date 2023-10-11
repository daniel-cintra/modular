<?php

use Illuminate\Support\Facades\Route;

Route::get('user', [
    'uses' => 'UserController@index',
])->name('user.index');

Route::get('user/create', [
    'uses' => 'UserController@create',
])->name('user.create');

Route::get('user/{id}/edit', [
    'uses' => 'UserController@edit',
])->name('user.edit');

Route::post('user', [
    'uses' => 'UserController@store',
])->name('user.store');

Route::put('user/{id}', [
    'uses' => 'UserController@update',
])->name('user.update');

Route::delete('user/{id}', [
    'uses' => 'UserController@destroy',
])->name('user.destroy');
