<?php

namespace Modules\AdminAuth\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class UserAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard('user')->guest()) {
            return redirect()->route('adminAuth.loginForm')
                ->withErrors(['email' => 'Session expired, please login again.']);
        }

        return $next($request);
    }
}
