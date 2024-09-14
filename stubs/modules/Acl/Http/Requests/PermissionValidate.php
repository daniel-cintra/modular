<?php

namespace Modules\Acl\Http\Requests;

use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Permission;
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

            'name' => [
                'required',
                'min:3',
                Rule::unique(Permission::class)->ignore($this->id),
            ]
            // 'guard_name' => 'required'

        ];
    }
}
