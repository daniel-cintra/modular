<?php

namespace Modules\AdminAuth\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Modules\Support\Http\Controllers\AppController;

class PasswordResetLinkController extends AppController
{
    /**
     * Display the password reset link request view.
     *
     * @return \Illuminate\View\View
     */
    public function forgotPasswordForm()
    {
        return inertia('AdminAuth/ForgotPage');
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $status = Password::broker('usersModule')->sendResetLink(
            $request->only('email')
        );

        return $status == Password::broker('usersModule')::RESET_LINK_SENT
            ? back()->with('success', __($status))
            : back()->withInput($request->only('email'))
                ->withErrors(['email' => __($status)]);
    }
}
