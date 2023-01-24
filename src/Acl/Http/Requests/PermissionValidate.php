<?php

namespace Modular\Modular\Acl\Http\Requests;

use Modular\Modular\Http\Requests\Request;

class PermissionValidate extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [

            'name' => 'required|min:3|unique:permissions,name',
            // 'guard_name' => 'required'

        ];
    }
}
