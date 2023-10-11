<?php

namespace Modules\Acl\Http\Requests;

use Modules\Support\Http\Requests\Request;

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
