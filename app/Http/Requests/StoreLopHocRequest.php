<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreLopHocRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    public function rules(): array
    {
        return [
            'ten_lop' => ['required', 'string', 'max:255'],
            'ma_lop' => ['required', 'string', 'max:255', 'unique:lop_hocs,ma_lop'],
            'giao_vien' => ['required', 'string', 'max:255'],
            'so_dien_thoai' => ['required', 'string', 'max:30'],
            'ghi_chu' => ['nullable', 'string'],
            'si_so' => ['required', 'integer', 'min:0'],
            'trang_thai' => ['required', Rule::in(['Hoạt động', 'Ngừng'])],
        ];
    }
}
