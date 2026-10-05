@extends('layouts.admin')

@section('title', 'Thêm sinh viên')

@section('content')
    <!-- The Sidebar -->
    @include('partials.sidebar')

    <!-- Main Content -->
    <div class="main-content">
        <h1 class="page-title">THÊM SINH VIÊN</h1>
        
        <div style="max-width: 600px;">
            <form method="POST" action="{{ route('sinhvien.store') }}">
                @csrf
                <div style="margin-bottom: 15px;">
                    <label for="ho_ten" style="display: block; margin-bottom: 5px; font-weight: bold;">Họ và Tên:</label>
                    <input type="text" id="ho_ten" name="ho_ten" required style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
                </div>
                
                <div style="margin-bottom: 15px;">
                    <label for="email" style="display: block; margin-bottom: 5px; font-weight: bold;">Email:</label>
                    <input type="email" id="email" name="email" required style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
                </div>
                
                <div style="margin-bottom: 15px;">
                    <label for="nganh" style="display: block; margin-bottom: 5px; font-weight: bold;">Ngành học:</label>
                    <input type="text" id="nganh" name="nganh" required style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
                </div>

                <div style="margin-bottom: 15px;">
                    <label for="phone_number" style="display: block; margin-bottom: 5px; font-weight: bold;">Số điện thoại:</label>
                    <input type="text" id="phone_number" name="phone_number" required style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
                </div>
                
                <div>
                    <button type="submit" style="padding: 10px 20px; background-color: #28a745; color: white; border: none; border-radius: 5px; cursor: pointer;">Lưu lại</button>
                    <a href="/sinhvien" style="padding: 10px 20px; background-color: #6c757d; color: white; text-decoration: none; border-radius: 5px; margin-left: 10px;">Hủy bỏ</a>
                </div>
            </form>
        </div>
    </div>
@endsection
