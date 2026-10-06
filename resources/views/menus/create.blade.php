@extends('layouts.admin')

@section('title', 'Thêm menu')

@include('menus._form-styles')

@section('content')
    @include('partials.sidebar')

    <div class="main-content menu-form-page">
        <div class="page-heading">
            <h1 class="page-title">Thêm menu</h1>
            <p class="page-subtitle">Điền thông tin để thêm liên kết vào header hoặc sidebar.</p>
        </div>

        <div class="form-card">
            <form action="{{ route('menu.store') }}" method="POST">
                @csrf
                @include('menus._form')

                <div class="form-actions">
                    <button type="submit" class="form-button form-button-primary">
                        <i class="fas fa-save" aria-hidden="true"></i>
                        Lưu menu
                    </button>
                    <a href="{{ route('menu.index') }}" class="form-button form-button-secondary">Hủy</a>
                </div>
            </form>
        </div>
    </div>
@endsection
