<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSinhVienRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    public function rules(): array
    {
        return [
            'lop_hoc_id' => ['nullable', 'integer', 'exists:lop_hocs,id'],
            'ho_ten' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:sinh_viens,email'],
            'nganh' => ['required', 'string', 'max:255'],
            'phone_number' => ['required', 'string', 'max:30'],
        ];
    }
}
