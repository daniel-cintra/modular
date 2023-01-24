<?php

namespace Modular\Modular\Acl\Http\Requests;

use Modular\Modular\Http\Requests\Request;

class RoleValidate extends Request
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

        ];
    }
}
