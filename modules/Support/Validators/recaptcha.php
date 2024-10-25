<?php

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

Validator::extend('recaptcha', function ($attribute, $value, $parameters, $validator) {

    $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
        'secret' => config('services.recaptcha.secret_key'),
        'response' => $value,
        'remoteip' => request()->ip(),
    ]);

    $body = $response->json();

    return $body['success'];
});
