@extends('layouts.admin')

@section('title', 'Danh sách sinh viên')

@push('styles')
    <style>
        .student-list-page .page-heading {
            margin-bottom: 24px;
        }

        .student-list-page .page-title {
            margin-bottom: 4px;
        }

        .student-list-page .page-subtitle {
            color: #64748b;
            font-size: 14px;
        }

        .student-list-page .add-student-button {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-top: 14px;
            padding: 10px 15px;
            border-radius: 7px;
            background: #0875e1;
            color: #fff;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            transition: background-color .15s;
        }

        .student-list-page .add-student-button:hover {
            background: #0563c2;
        }

        .student-list-page .table-card {
            overflow: hidden;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            background: #fff;
            box-shadow: 0 4px 16px rgb(15 23 42 / 5%);
        }

        .student-list-page .table-scroll {
            overflow-x: auto;
        }

        .student-list-page .student-table {
            width: 100%;
            min-width: 700px;
            border-collapse: separate;
            border-spacing: 0;
            text-align: left;
        }

        .student-list-page .student-table th {
            padding: 13px 16px;
            background: #f1f5f9;
            color: #334155;
            font-size: 13px;
            font-weight: 700;
            white-space: nowrap;
        }

        .student-list-page .student-table td {
            padding: 13px 16px;
            border-top: 1px solid #edf1f5;
            color: #334155;
            font-size: 14px;
        }

        .student-list-page .student-table tbody tr {
            transition: background-color .15s;
        }

        .student-list-page .student-table tbody tr:hover {
            background: #f8fbff;
        }

        .student-list-page .student-id {
            color: #64748b !important;
            font-variant-numeric: tabular-nums;
        }

        .student-list-page .student-actions {
            text-align: center;
            white-space: nowrap;
        }

        .student-list-page .student-detail-button {
            display: inline-flex;
            align-items: center;
            min-height: 32px;
            padding: 6px 10px;
            border-radius: 6px;
            background: #0891b2;
            color: #fff;
            font-size: 12px;
            font-weight: 600;
            text-decoration: none;
            transition: background-color .15s;
        }

        .student-list-page .student-detail-button:hover {
            background: #0e7490;
        }

        .student-list-page .empty-state {
            padding: 32px 16px !important;
            color: #64748b !important;
            text-align: center;
        }

        .student-list-page .pagination-wrapper {
            margin-top: 22px;
        }

        @media (max-width: 700px) {
            .student-list-page .pagination-wrapper {
                flex-direction: column;
                gap: 8px;
            }
        }
    </style>
@endpush

@section('content')
    @include('partials.sidebar')

    <div class="main-content student-list-page">
        <div class="page-heading">
            <h1 class="page-title">Danh sách sinh viên</h1>
            <p class="page-subtitle">Tra cứu thông tin sinh viên theo tên, email, ngành học hoặc số điện thoại.</p>
            <a href="{{ route('sinhvien.add') }}" class="add-student-button">
                <i class="fas fa-plus" aria-hidden="true"></i>
                Thêm sinh viên
            </a>
        </div>

        <form action="{{ route('sinhvien.index') }}" method="GET" class="list-search">
            <label for="student-search">Từ khóa</label>
            <div class="list-search-controls">
                <input
                    id="student-search"
                    type="search"
                    name="q"
                    value="{{ is_string(request('q')) ? request('q') : '' }}"
                    placeholder="Họ tên, email, ngành học, số điện thoại..."
                    aria-invalid="@error('q') true @else false @enderror"
                >
                <button type="submit" class="list-search-button">Tìm kiếm</button>
                @if (request()->filled('q'))
                    <a href="{{ route('sinhvien.index') }}" class="list-search-clear">Xóa lọc</a>
                @endif
            </div>
            @error('q')
                <p class="list-search-error">{{ $message }}</p>
            @enderror
        </form>

        <p class="list-search-results">
            Tìm thấy <strong>{{ $sinhviens->total() }}</strong> sinh viên
        </p>

        <div class="table-card">
            <div class="table-scroll">
                <table class="student-table">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Họ và tên</th>
                            <th scope="col">Email</th>
                            <th scope="col">Ngành học</th>
                            <th scope="col">Số điện thoại</th>
                            <th scope="col" class="student-actions">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($sinhviens as $sv)
                            <tr>
                                <td class="student-id">{{ $sv->id }}</td>
                                <td>{{ $sv->ho_ten }}</td>
                                <td>{{ $sv->email }}</td>
                                <td>{{ $sv->nganh }}</td>
                                <td>{{ $sv->phone_number }}</td>
                                <td class="student-actions">
                                    <a href="/sinhvien/show/{{ $sv->id }}" class="student-detail-button">Chi tiết</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="empty-state">Không tìm thấy sinh viên phù hợp.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{ $sinhviens->links('pagination.centered') }}
    </div>
@endsection
