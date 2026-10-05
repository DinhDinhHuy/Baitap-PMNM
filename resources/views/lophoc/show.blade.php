@extends('layouts.admin')

@section('title', 'Chi tiết lớp học')

@section('content')
    <!-- The Sidebar -->
    @include('partials.sidebar')

    <!-- Main Content -->
    <div class="main-content">
        <h1 class="page-title">CHI TIẾT LỚP HỌC</h1>
        
        <div style="max-width: 600px; margin-top: 20px;">
            <p><strong>ID:</strong> {{ $lophoc->id }}</p>
            <p><strong>Tên Lớp:</strong> {{ $lophoc->ten_lop }}</p>
            <p><strong>Mã Lớp:</strong> {{ $lophoc->ma_lop }}</p>
            <p><strong>Giáo viên:</strong> {{ $lophoc->giao_vien }}</p>
            <p><strong>Số điện thoại:</strong> {{ $lophoc->so_dien_thoai }}</p>
            <p><strong>Ghi chú:</strong> {{ $lophoc->ghi_chu }}</p>
            <p><strong>Sĩ số:</strong> {{ $lophoc->si_so }}</p>

            <div style="margin-top: 20px;">
                <a href="{{ route('lophoc.index') }}" style="padding: 10px 20px; background-color: #6c757d; color: white; text-decoration: none; border-radius: 5px;">Quay lại danh sách</a>
            </div>
        </div>
    </div>
@endsection
