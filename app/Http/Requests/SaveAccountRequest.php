<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SaveAccountRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    public function rules(): array
    {
        $userId = $this->route('user')?->id;
        if ($userId === null && ! $this->isMethod('POST')) {
            $userId = $this->user()->id;
        }
        $emailRule = Rule::unique('users', 'email');
        if ($userId !== null) {
            $emailRule->ignore($userId);
        }

        $isManagingUsers = $this->routeIs('users.*');

        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', $emailRule],
            'role' => [($isManagingUsers && $this->user()->isAdmin()) ? 'required' : 'nullable', Rule::in(['admin', 'lecturer'])],
            'password' => [$this->isMethod('POST') ? 'required' : 'nullable', 'string', 'min:8', 'confirmed'],
        ];
    }

    public function validatedAccount(): array
    {
        $data = $this->validated();
        if (empty($data['password'])) {
            unset($data['password']);
        }

        if (! $this->user()->isAdmin() || $this->routeIs('account.*')) {
            unset($data['role']);
        }

        return $data;
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Họ và tên không được để trống.',
            'email.required' => 'Email không được để trống.',
            'email.email' => 'Địa chỉ email không đúng định dạng.',
            'email.unique' => 'Địa chỉ email này đã được sử dụng.',
            'role.required' => 'Vui lòng chọn vai trò cho tài khoản.',
            'password.required' => 'Mật khẩu không được để trống.',
            'password.min' => 'Mật khẩu phải có tối thiểu :min ký tự.',
            'password.confirmed' => 'Xác nhận lại mật khẩu không trùng khớp.',
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'họ và tên',
            'email' => 'email',
            'role' => 'vai trò',
            'password' => 'mật khẩu',
            'password_confirmation' => 'xác nhận mật khẩu',
        ];
    }
}
