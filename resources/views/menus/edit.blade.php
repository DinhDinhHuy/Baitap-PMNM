@extends('layouts.admin')

@section('title', 'Sửa menu')

@include('menus._form-styles')

@section('content')
    @include('partials.sidebar')

    <div class="main-content menu-form-page">
        <div class="page-heading">
            <h1 class="page-title">Sửa menu</h1>
            <p class="page-subtitle">Cập nhật thông tin menu “{{ $menu->ten }}”.</p>
        </div>

        <div class="form-card">
            <form action="{{ route('menu.update', $menu) }}" method="POST">
                @csrf
                @method('PUT')
                @include('menus._form', ['menu' => $menu])

                <div class="form-actions">
                    <button type="submit" class="form-button form-button-primary">
                        <i class="fas fa-save" aria-hidden="true"></i>
                        Lưu thay đổi
                    </button>
                    <a href="{{ route('menu.index') }}" class="form-button form-button-secondary">Hủy</a>
                </div>
            </form>
        </div>
    </div>
@endsection
