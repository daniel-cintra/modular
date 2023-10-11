<?php

namespace Modules\Acl\Http\Requests;

use Modules\Support\Http\Requests\Request;

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
