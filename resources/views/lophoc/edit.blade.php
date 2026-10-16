@extends('layouts.admin')

@section('title', 'Cập nhật lớp học')

@section('content')
    @include('partials.sidebar')
    <div class="main-content">
        <h1 class="page-title">CẬP NHẬT LỚP HỌC</h1>
        @include('lophoc._form')
    </div>
@endsection
