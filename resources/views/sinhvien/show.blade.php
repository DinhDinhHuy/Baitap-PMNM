@extends('layouts.admin')

@section('title', 'Chi tiết sinh viên')

@section('content')
    @include('partials.sidebar')

    <div class="main-content">
        <h1 class="page-title">CHI TIẾT SINH VIÊN</h1>

        <div style="max-width: 600px; margin-top: 20px;">
            <p><strong>ID:</strong> {{ $sinhvien->id }}</p>
            <p><strong>Họ và tên:</strong> {{ $sinhvien->ho_ten }}</p>
            <p><strong>Email:</strong> {{ $sinhvien->email }}</p>
            <p><strong>Ngành học:</strong> {{ $sinhvien->nganh }}</p>
            <p><strong>Số điện thoại:</strong> {{ $sinhvien->phone_number }}</p>

            <div style="margin-top: 20px;">
                <a href="{{ route('sinhvien.index') }}" style="padding: 10px 20px; background-color: #6c757d; color: white; text-decoration: none; border-radius: 5px;">Quay lại danh sách</a>
            </div>
        </div>
    </div>
@endsection
