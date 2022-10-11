@component('mail::message')
# Forgot your password?

Here is your password reset link.

@component('mail::button', ['url' => $url])
Reset Password
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent