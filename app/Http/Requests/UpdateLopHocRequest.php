<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class UpdateLopHocRequest extends StoreLopHocRequest
{
    public function rules(): array
    {
        $rules = parent::rules();
        $rules['ma_lop'] = [
            'required',
            'string',
            'max:255',
            Rule::unique('lop_hocs', 'ma_lop')->ignore($this->route('lophoc')),
        ];

        return $rules;
    }
}
