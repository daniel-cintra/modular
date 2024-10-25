<?php

namespace Modules\Acl\Http\Requests;

use Illuminate\Validation\Rule;
use Modules\Support\Http\Requests\Request;
use Spatie\Permission\Models\Permission;

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

            'name' => [
                'required',
                'string',
                'min:3',
                'max:255',
                Rule::unique(Permission::class)->ignore($this->id),
            ],

        ];
    }
}
