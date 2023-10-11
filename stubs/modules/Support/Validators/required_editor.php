<?php

use Illuminate\Support\Facades\Validator;

Validator::extend('required_editor', function ($attribute, $value, $parameters, $validator) {
    if (! is_null($value) and $value != '<p></p>') {
        return true;
    }

    return false;
}, trans('modular::validation.required_editor'));
