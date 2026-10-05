@extends('layouts.admin')

@section('title', 'Cập nhật lớp học')

@section('content')
    <!-- The Sidebar -->
    @include('partials.sidebar')

    <!-- Main Content -->
    <div class="main-content">
        <h1 class="page-title">CẬP NHẬT LỚP HỌC</h1>
        
        <div style="max-width: 600px;">
            <form method="POST" action="{{ route('lophoc.update', $lophoc->id) }}">
                @csrf
                @method('PUT')
                <div style="margin-bottom: 15px;">
                    <label for="ten_lop" style="display: block; margin-bottom: 5px; font-weight: bold;">Tên lớp:</label>
                    <input type="text" id="ten_lop" name="ten_lop" value="{{ $lophoc->ten_lop }}" required style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
                </div>
                
                <div style="margin-bottom: 15px;">
                    <label for="ma_lop" style="display: block; margin-bottom: 5px; font-weight: bold;">Mã lớp:</label>
                    <input type="text" id="ma_lop" name="ma_lop" value="{{ $lophoc->ma_lop }}" required style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
                </div>
                
                <div style="margin-bottom: 15px;">
                    <label for="giao_vien" style="display: block; margin-bottom: 5px; font-weight: bold;">Giáo viên:</label>
                    <input type="text" id="giao_vien" name="giao_vien" value="{{ $lophoc->giao_vien }}" required style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
                </div>

                <div style="margin-bottom: 15px;">
                    <label for="so_dien_thoai" style="display: block; margin-bottom: 5px; font-weight: bold;">Số điện thoại:</label>
                    <input type="text" id="so_dien_thoai" name="so_dien_thoai" value="{{ $lophoc->so_dien_thoai }}" required style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
                </div>

                <div style="margin-bottom: 15px;">
                    <label for="ghi_chu" style="display: block; margin-bottom: 5px; font-weight: bold;">Ghi chú:</label>
                    <textarea id="ghi_chu" name="ghi_chu" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">{{ $lophoc->ghi_chu }}</textarea>
                </div>

                <div style="margin-bottom: 15px;">
                    <label for="si_so" style="display: block; margin-bottom: 5px; font-weight: bold;">Sĩ số:</label>
                    <input type="number" id="si_so" name="si_so" value="{{ $lophoc->si_so }}" min="0" required style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
                </div>

                <div style="margin-bottom: 15px;">
                    <label for="trang_thai" style="display: block; margin-bottom: 5px; font-weight: bold;">Trạng thái:</label>
                    <select id="trang_thai" name="trang_thai" required style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
                        <option value="Hoạt động" @selected(old('trang_thai', $lophoc->trang_thai) === 'Hoạt động')>Hoạt động</option>
                        <option value="Ngừng" @selected(old('trang_thai', $lophoc->trang_thai) === 'Ngừng')>Ngừng</option>
                    </select>
                </div>
                
                <div>
                    <button type="submit" style="padding: 10px 20px; background-color: #28a745; color: white; border: none; border-radius: 5px; cursor: pointer;">Cập nhật</button>
                    <a href="{{ route('lophoc.index') }}" style="padding: 10px 20px; background-color: #6c757d; color: white; text-decoration: none; border-radius: 5px; margin-left: 10px;">Hủy bỏ</a>
                </div>
            </form>
        </div>
    </div>
@endsection
