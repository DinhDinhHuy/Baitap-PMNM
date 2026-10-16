@extends('layouts.admin')

@section('title', 'Thêm sinh viên')

@section('content')
    @include('partials.sidebar')
    <div class="main-content">
        <h1 class="page-title">THÊM SINH VIÊN</h1>
        @include('sinhvien._form', ['sinhvien' => new \App\Models\SinhVien()])
    </div>
@endsection
