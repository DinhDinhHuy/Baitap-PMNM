@extends('layouts.admin')

@section('title', 'Đăng nhập')

@section('content')
    <div class="main-content" style="max-width:440px;margin:30px auto;padding:28px;border:1px solid #e2e8f0;border-radius:10px;box-shadow:0 4px 16px rgb(15 23 42 / 5%)">
        <h1 class="page-title">ĐĂNG NHẬP HỆ THỐNG</h1>
        @if ($errors->any())
            <div role="alert" style="margin:16px 0;padding:12px;background:#fee2e2;color:#991b1b;border-radius:6px">
                {{ $errors->first() }}
            </div>
        @endif
        <form method="POST" action="{{ route('login.post') }}">
            @csrf
            <div style="margin:16px 0">
                <label for="email">Email đăng nhập</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus style="display:block;width:100%;padding:11px">
            </div>
            <div style="margin:16px 0">
                <label for="password">Mật khẩu</label>
                <input type="password" id="password" name="password" required style="display:block;width:100%;padding:11px">
            </div>
            <button class="list-search-button" type="submit" style="width:100%">Đăng nhập</button>
        </form>
    </div>
@endsection
