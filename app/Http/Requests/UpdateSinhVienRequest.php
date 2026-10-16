<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class UpdateSinhVienRequest extends StoreSinhVienRequest
{
    public function rules(): array
    {
        $rules = parent::rules();
        $rules['email'] = [
            'required',
            'email',
            'max:255',
            Rule::unique('sinh_viens', 'email')->ignore($this->route('sinhvien')),
        ];

        return $rules;
    }
}
