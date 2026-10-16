@extends('layouts.admin')

@section('title', $isOwnAccount ? 'Tài khoản của tôi' : ($user->exists ? 'Sửa tài khoản' : 'Tạo tài khoản'))

@section('content')
    @include('partials.sidebar')
    <div class="main-content">
        <div style="margin-bottom: 24px;">
            <h1 class="page-title">{{ $isOwnAccount ? 'Tài khoản của tôi' : ($user->exists ? 'Chỉnh sửa tài khoản' : 'Tạo tài khoản mới') }}</h1>
            <p style="color: #64748b; font-size: 14px; margin: 0;">
                {{ $isOwnAccount ? 'Cập nhật thông tin cá nhân và mật khẩu của bạn.' : ($user->exists ? 'Cập nhật quyền hạn và thông tin người dùng.' : 'Thêm tài khoản người dùng mới vào hệ thống.') }}
            </p>
        </div>

        <div style="max-width: 650px; background: #fff; padding: 28px; border: 1px solid #e2e8f0; border-radius: 12px; box-shadow: 0 4px 16px rgba(15, 23, 42, 0.05);">
            <form method="POST" action="{{ $isOwnAccount ? route('account.update') : ($user->exists ? route('users.update', $user) : route('users.store')) }}">
                @csrf
                @if ($user->exists && ! $isOwnAccount) @method('PUT') @endif
                @if ($isOwnAccount) @method('PUT') @endif

                <div style="margin-bottom: 18px;">
                    <label for="name" style="display: block; margin-bottom: 6px; font-weight: 600; color: #334155; font-size: 14px;">Họ và tên <span style="color:#ef4444">*</span></label>
                    <input id="name" name="name" required maxlength="255" value="{{ old('name', $user->name) }}" placeholder="Ví dụ: Nguyễn Văn An" style="display: block; width: 100%; padding: 10px 14px; border: 1px solid #cbd5e1; border-radius: 7px; font-size: 14px; color: #1e293b;">
                    @error('name') <p class="list-search-error" style="color: #ef4444; font-size: 13px; margin-top: 5px;">{{ $message }}</p> @enderror
                </div>

                <div style="margin-bottom: 18px;">
                    <label for="email" style="display: block; margin-bottom: 6px; font-weight: 600; color: #334155; font-size: 14px;">Địa chỉ Email <span style="color:#ef4444">*</span></label>
                    <input id="email" type="email" name="email" required maxlength="255" value="{{ old('email', $user->email) }}" placeholder="name@example.com" style="display: block; width: 100%; padding: 10px 14px; border: 1px solid #cbd5e1; border-radius: 7px; font-size: 14px; color: #1e293b;">
                    @error('email') <p class="list-search-error" style="color: #ef4444; font-size: 13px; margin-top: 5px;">{{ $message }}</p> @enderror
                </div>

                @if (! $isOwnAccount)
                    <div style="margin-bottom: 18px;">
                        <label for="role" style="display: block; margin-bottom: 6px; font-weight: 600; color: #334155; font-size: 14px;">Phân quyền hệ thống <span style="color:#ef4444">*</span></label>
                        <select id="role" name="role" required style="display: block; width: 100%; padding: 10px 14px; border: 1px solid #cbd5e1; border-radius: 7px; font-size: 14px; color: #1e293b; background: #fff;">
                            <option value="admin" @selected(old('role', $user->role) === 'admin')>Admin (Toàn quyền quản trị)</option>
                            <option value="lecturer" @selected(old('role', $user->role ?? 'lecturer') === 'lecturer')>Giảng viên (Quản lý lớp, sinh viên & tài khoản cá nhân)</option>
                        </select>
                        @error('role') <p class="list-search-error" style="color: #ef4444; font-size: 13px; margin-top: 5px;">{{ $message }}</p> @enderror
                    </div>
                @endif

                <div style="padding: 16px; background: #f8fafc; border-radius: 8px; border: 1px solid #e2e8f0; margin-bottom: 22px;">
                    <div style="font-weight: 600; color: #334155; font-size: 14px; margin-bottom: 12px;">
                        <i class="fas fa-lock" style="color: #64748b; margin-right: 4px;"></i> 
                        {{ $user->exists ? 'Đổi mật khẩu (bỏ trống nếu muốn giữ mật khẩu cũ)' : 'Thiết lập mật khẩu' }}
                    </div>

                    <div style="margin-bottom: 14px;">
                        <label for="password" style="display: block; margin-bottom: 5px; font-size: 13px; color: #475569;">{{ $user->exists ? 'Mật khẩu mới' : 'Mật khẩu' }} {{ $user->exists ? '' : '*' }}</label>
                        <input id="password" type="password" name="password" {{ $user->exists ? '' : 'required' }} minlength="8" placeholder="Tối thiểu 8 ký tự" style="display: block; width: 100%; padding: 9px 12px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 14px; background: #fff;">
                        @error('password') <p class="list-search-error" style="color: #ef4444; font-size: 13px; margin-top: 5px;">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="password_confirmation" style="display: block; margin-bottom: 5px; font-size: 13px; color: #475569;">Xác nhận lại mật khẩu {{ $user->exists ? '' : '*' }}</label>
                        <input id="password_confirmation" type="password" name="password_confirmation" {{ $user->exists ? '' : 'required' }} minlength="8" placeholder="Nhập lại mật khẩu" style="display: block; width: 100%; padding: 9px 12px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 14px; background: #fff;">
                    </div>
                </div>

                <div style="display: flex; gap: 10px; align-items: center;">
                    <button type="submit" class="list-search-button" style="padding: 10px 22px; font-weight: 600;">
                        <i class="fas fa-save" style="margin-right: 6px;"></i> Lưu thay đổi
                    </button>
                    @unless ($isOwnAccount)
                        <a href="{{ route('users.index') }}" class="list-search-clear" style="padding: 10px 18px;">Hủy bỏ</a>
                    @endunless
                </div>
            </form>
        </div>
    </div>
@endsection
