@extends('layouts.admin')

@section('title', 'Chỉnh sửa sinh viên')

@section('content')
    @include('partials.sidebar')
    <div class="main-content">
        <h1 class="page-title">CHỈNH SỬA SINH VIÊN</h1>
        @include('sinhvien._form')
    </div>
@endsection
