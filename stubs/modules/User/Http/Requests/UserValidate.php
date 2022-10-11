<?php

namespace Modules\User\Http\Requests;

use Modules\Support\Http\Requests\Request;
use Illuminate\Validation\Rules\Password;

class UserValidate extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'required|email',
            'password' => $this->passwordRules(),
            // 'profile_type' => '',
            // 'profile_id' => ''

        ];
    }

    private function passwordRules()
    {
        $rules = [Password::min(8)];

        if (request()->isMethod('post')) {
            array_unshift($rules, ['required']);
        }

        if (request()->isMethod('put') and request()->isEmptyString('password')) {
            return [];
        }

        return $rules;
    }
}
