<?php

namespace Modules\Acl\Http\Requests;

use Illuminate\Validation\Rule;
use Modules\Support\Http\Requests\Request;
use Spatie\Permission\Models\Role;

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

            'name' => [
                'required',
                'string',
                'min:2',
                'max:255',
                Rule::unique(Role::class)->ignore($this->id),
            ],

        ];
    }
}
