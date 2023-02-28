<?php

use Illuminate\Support\Facades\Route;

Route::get(config('modular.login-url'), [
    'uses' => 'AuthenticatedSessionController@loginForm',
])->name('adminAuth.loginForm');

Route::post('/admin-auth/login', [
    'uses' => 'AuthenticatedSessionController@login',
])->name('adminAuth.login');

Route::get('/admin-auth/logout', [
    'uses' => 'AuthenticatedSessionController@logout',
])->name('adminAuth.logout');

// form to receive the email that contains the link to reset password
Route::get('/admin-auth/forgot-password', [
    'uses' => 'PasswordResetLinkController@forgotPasswordForm',
])->name('adminAuth.forgotPassword');

Route::post('/admin-auth/send-reset-link-email', [
    'uses' => 'PasswordResetLinkController@sendResetLinkEmail',
])->name('adminAuth.sendResetLinkEmail');

// password reset form
Route::get('/admin-auth/reset-password/{token}', [
    'uses' => 'NewPasswordController@resetPasswordForm',
])->name('adminAuth.resetPasswordForm');

Route::post('/admin-auth/reset-password', [
    'uses' => 'NewPasswordController@store',
])->name('adminAuth.resetPassword');
