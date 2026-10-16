@extends('layouts.admin')

@section('title', 'Thêm lớp học')

@section('content')
    @include('partials.sidebar')
    <div class="main-content">
        <h1 class="page-title">THÊM LỚP HỌC</h1>
        @include('lophoc._form')
    </div>
@endsection
