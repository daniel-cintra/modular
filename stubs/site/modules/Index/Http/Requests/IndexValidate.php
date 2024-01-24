<?php

namespace Modules\Index\Http\Requests;

use Modular\Modular\Http\Requests\Request;

class IndexValidate extends Request
{
    public function rules(): array
    {
        return [
            // 'name' => 'required',
        ];
    }
}
