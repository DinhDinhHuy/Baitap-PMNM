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
            <div class="list-search-options">
                <div>
                    <label for="student-major">Ngành học</label>
                    <input id="student-major" name="nganh" value="{{ request('nganh') }}" placeholder="Lọc theo ngành">
                </div>
                <div>
                    <label for="student-class">Lớp học</label>
                    <select id="student-class" name="lop_hoc_id">
                        <option value="">Tất cả lớp</option>
                        @foreach ($lophocs as $lop)
                            <option value="{{ $lop->id }}" @selected((string) request('lop_hoc_id') === (string) $lop->id)>{{ $lop->ten_lop }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="student-per-page">Số dòng mỗi trang</label>
                    <select id="student-per-page" name="per_page">
                        @foreach ([5, 10, 25, 50] as $option)
                            <option value="{{ $option }}" @selected((int) request('per_page', 10) === $option)>{{ $option }}</option>
                        @endforeach
                    </select>
                </div>
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
                            @foreach (['id' => 'ID', 'ho_ten' => 'Họ và tên', 'email' => 'Email', 'nganh' => 'Ngành học', 'phone_number' => 'Số điện thoại'] as $column => $label)
                                <th scope="col"><a href="{{ route('sinhvien.index', array_merge(request()->query(), ['sort' => $column, 'direction' => $sort === $column && $direction === 'asc' ? 'desc' : 'asc'])) }}">{{ $label }} @if ($sort === $column){{ $direction === 'asc' ? '↑' : '↓' }}@endif</a></th>
                            @endforeach
                            <th scope="col">Lớp</th>
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
                                <td>{{ $sv->lopHoc?->ten_lop ?? 'Chưa xếp lớp' }}</td>
                                <td class="student-actions">
                                    <a href="{{ route('sinhvien.show', $sv) }}" class="student-detail-button">Chi tiết</a>
                                    <a href="{{ route('sinhvien.edit', $sv) }}" class="student-detail-button">Sửa</a>
                                    <form action="{{ route('sinhvien.destroy', $sv) }}" method="POST" style="display:inline" onsubmit="return confirm('Bạn có chắc chắn muốn xóa sinh viên này?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="student-detail-button" style="border:0;background:#b91c1c;cursor:pointer">Xóa</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="empty-state">Không tìm thấy sinh viên phù hợp.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{ $sinhviens->links('pagination.centered') }}
    </div>
@endsection
