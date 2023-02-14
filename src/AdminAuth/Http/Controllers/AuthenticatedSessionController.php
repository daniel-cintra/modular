<?php

namespace Modular\Modular\AdminAuth\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Modular\Modular\AdminAuth\Http\Requests\LoginRequest;
use Modular\Modular\Http\Controllers\AppController;

class AuthenticatedSessionController extends AppController
{
    /**
     * Display the login view.
     *
     * @return \Inertia\Response
     */
    public function loginForm()
    {
        return inertia('AdminAuth/LoginForm');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(route('dashboard.index'));
    }

    /**
     * Destroy an authenticated session.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        Auth::guard('user')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return Inertia::location('/');
    }
}
