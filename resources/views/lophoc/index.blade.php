@extends('layouts.admin')

@section('title', 'Danh sách Lớp Học')

@push('styles')
    <style>
        .class-list-page .page-heading {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            margin-bottom: 24px;
        }

        .class-list-page .page-title {
            margin-bottom: 4px;
        }

        .class-list-page .page-subtitle {
            color: #64748b;
            font-size: 14px;
        }

        .class-list-page .class-search-panel {
            margin-bottom: 18px;
            padding: 16px;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            background: #fff;
            box-shadow: 0 3px 12px rgb(15 23 42 / 4%);
        }

        .class-list-page .class-filter-grid {
            display: grid;
            grid-template-columns: minmax(220px, 2fr) repeat(4, minmax(110px, 1fr));
            gap: 8px;
            align-items: end;
        }

        .class-list-page .class-filter-field {
            min-width: 0;
        }

        .class-list-page .class-filter-field label {
            display: block;
            margin-bottom: 5px;
            color: #334155;
            font-size: 13px;
            font-weight: 500;
        }

        .class-list-page .class-search-panel .class-filter-field input,
        .class-list-page .class-search-panel .class-filter-field select {
            width: 100%;
            min-height: 37px;
            padding: 7px 10px;
            border: 1px solid #cbd5e1;
            border-radius: 5px;
            background: #fff;
            color: #1e293b;
            font-size: 14px;
        }

        .class-list-page .class-search-panel .class-filter-field input:focus,
        .class-list-page .class-search-panel .class-filter-field select:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 2px rgb(59 130 246 / 15%);
            outline: 0;
        }

        .class-list-page .class-filter-actions {
            display: flex;
            gap: 6px;
            margin-top: 8px;
        }

        .class-list-page .class-search-panel .list-search-button,
        .class-list-page .class-search-panel .list-search-clear {
            min-height: 36px;
            padding: 7px 11px;
            border-radius: 5px;
            font-size: 14px;
        }

        .class-list-page .add-class-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 11px 16px;
            border: 0;
            border-radius: 8px;
            background: #0875e1;
            box-shadow: 0 4px 10px rgb(8 117 225 / 18%);
            color: #fff;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            white-space: nowrap;
            transition: background-color .2s, box-shadow .2s, transform .2s;
        }

        .class-list-page .add-class-button:hover {
            background: #0563c2;
            box-shadow: 0 6px 14px rgb(8 117 225 / 24%);
            transform: translateY(-1px);
        }

        .class-list-page .add-class-button:focus-visible,
        .class-list-page .action-button:focus-visible,
        .class-list-page .page-link:focus-visible {
            outline: 3px solid #93c5fd;
            outline-offset: 2px;
        }

        .class-list-page .table-card {
            overflow: hidden;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            background: #fff;
            box-shadow: 0 4px 16px rgb(15 23 42 / 5%);
        }

        .class-list-page .table-scroll {
            overflow-x: auto;
        }

        .class-list-page .class-table {
            width: 100%;
            min-width: 850px;
            border-collapse: separate;
            border-spacing: 0;
            text-align: left;
        }

        .class-list-page .class-table th {
            padding: 13px 16px;
            background: #f1f5f9;
            color: #334155;
            font-size: 13px;
            font-weight: 700;
            letter-spacing: .02em;
            white-space: nowrap;
        }

        .class-list-page .class-table td {
            padding: 13px 16px;
            border-top: 1px solid #edf1f5;
            color: #334155;
            font-size: 14px;
        }

        .class-list-page .class-table tbody tr {
            transition: background-color .15s;
        }

        .class-list-page .class-table tbody tr:hover {
            background: #f8fbff;
        }

        .class-list-page .class-table .class-id {
            color: #64748b;
            font-variant-numeric: tabular-nums;
        }

        .class-list-page .class-code {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 5px;
            background: #eff6ff;
            color: #1d4ed8;
            font-size: 13px;
            font-weight: 600;
        }

        .class-list-page .class-size {
            color: #0f172a;
            font-weight: 600;
            font-variant-numeric: tabular-nums;
        }

        .class-list-page .status-badge {
            display: inline-block;
            padding: 3px 9px;
            border-radius: 5px;
            color: #fff;
            font-size: 12px;
            font-weight: 600;
            white-space: nowrap;
        }

        .class-list-page .status-active {
            background: #388b57;
        }

        .class-list-page .status-stopped {
            background: #737d88;
        }

        .class-list-page .actions-heading,
        .class-list-page .actions-cell {
            text-align: center;
        }

        .class-list-page .actions-cell {
            white-space: nowrap;
        }

        .class-list-page .action-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 32px;
            padding: 6px 10px;
            border: 1px solid transparent;
            border-radius: 6px;
            color: #fff;
            font-size: 12px;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            transition: background-color .15s, border-color .15s;
        }

        .class-list-page .action-detail {
            background: #0891b2;
        }

        .class-list-page .action-detail:hover {
            background: #0e7490;
        }

        .class-list-page .action-edit {
            background: #fff;
            border-color: #cbd5e1;
            color: #334155;
        }

        .class-list-page .action-edit:hover {
            background: #f1f5f9;
        }

        .class-list-page .action-delete {
            background: #fff;
            border-color: #fecaca;
            color: #b91c1c;
        }

        .class-list-page .action-delete:hover {
            background: #fef2f2;
        }

        .class-list-page .delete-form {
            display: inline;
        }

        .class-list-page .empty-state {
            padding: 32px 16px !important;
            color: #64748b !important;
            text-align: center;
        }

        .class-list-page .pagination-wrapper {
            margin-top: 22px;
        }

        .class-list-page .pagination-summary {
            color: #64748b;
        }

        .class-list-page .page-link {
            border-color: #e2e8f0;
            border-radius: 6px;
            font-size: 14px;
            transition: color .15s, background-color .15s, border-color .15s;
        }

        .class-list-page .page-item.active .page-link {
            box-shadow: 0 2px 6px rgb(1 43 93 / 18%);
        }

        @media (max-width: 700px) {
            .class-list-page .page-heading {
                align-items: flex-start;
                flex-direction: column;
            }

            .class-list-page .class-filter-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .class-list-page .pagination-wrapper {
                flex-direction: column;
                gap: 8px;
            }
        }
    </style>
@endpush

@section('content')
    @include('partials.sidebar')

    <div class="main-content class-list-page">
        <div class="page-heading">
            <div>
                <h1 class="page-title">Danh sách lớp học</h1>
                <p class="page-subtitle">Theo dõi thông tin các lớp học và giáo viên phụ trách.</p>
            </div>
            <a href="{{ route('lophoc.create') }}" class="add-class-button">
                <i class="fas fa-plus" aria-hidden="true"></i>
                Thêm lớp học
            </a>
        </div>

        <form action="{{ route('lophoc.index') }}" method="GET" class="list-search class-search-panel">
            <div class="class-filter-grid">
                <div class="class-filter-field">
                    <label for="class-search">Từ khóa</label>
                    <input
                        id="class-search"
                        type="search"
                        name="q"
                        value="{{ is_string(request('q')) ? request('q') : '' }}"
                        placeholder="Tên lớp, mã lớp, giáo viên..."
                        aria-invalid="@error('q') true @else false @enderror"
                    >
                    @error('q')
                        <p class="list-search-error">{{ $message }}</p>
                    @enderror
                </div>
                <div class="class-filter-field">
                    <label for="class-status">Trạng thái</label>
                    <select id="class-status" name="trang_thai">
                        <option value="">Tất cả</option>
                        <option value="Hoạt động" @selected(request('trang_thai') === 'Hoạt động')>Hoạt động</option>
                        <option value="Ngừng" @selected(request('trang_thai') === 'Ngừng')>Ngừng</option>
                    </select>
                    @error('trang_thai')
                        <p class="list-search-error">{{ $message }}</p>
                    @enderror
                </div>
                <div class="class-filter-field">
                    <label for="class-size-from">Sĩ số từ</label>
                    <input
                        id="class-size-from"
                        type="number"
                        name="si_so_tu"
                        min="0"
                        value="{{ is_string(request('si_so_tu')) || is_numeric(request('si_so_tu')) ? request('si_so_tu') : '' }}"
                        aria-invalid="@error('si_so_tu') true @else false @enderror"
                    >
                    @error('si_so_tu')
                        <p class="list-search-error">{{ $message }}</p>
                    @enderror
                </div>
                <div class="class-filter-field">
                    <label for="class-size-to">Đến</label>
                    <input
                        id="class-size-to"
                        type="number"
                        name="si_so_den"
                        min="0"
                        value="{{ is_string(request('si_so_den')) || is_numeric(request('si_so_den')) ? request('si_so_den') : '' }}"
                        aria-invalid="@error('si_so_den') true @else false @enderror"
                    >
                    @error('si_so_den')
                        <p class="list-search-error">{{ $message }}</p>
                    @enderror
                </div>
                <div class="class-filter-field">
                    <label for="class-per-page">Số dòng / trang</label>
                    <select id="class-per-page" name="per_page">
                        @foreach ([5, 10, 25, 50] as $option)
                            <option value="{{ $option }}" @selected((int) request('per_page', 10) === $option)>{{ $option }}</option>
                        @endforeach
                    </select>
                    @error('per_page')
                        <p class="list-search-error">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="class-filter-actions">
                <button type="submit" class="list-search-button">Tìm kiếm</button>
                <a href="{{ route('lophoc.index') }}" class="list-search-clear">Xóa lọc</a>
            </div>

        </form>

        <p class="list-search-results">
            Tìm thấy <strong>{{ $lophocs->total() }}</strong> lớp học
        </p>

        <div class="table-card">
            <div class="table-scroll">
                <table class="class-table">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Tên lớp</th>
                            <th scope="col">Mã lớp</th>
                            <th scope="col">Giáo viên</th>
                            <th scope="col">Số điện thoại</th>
                            <th scope="col">Sĩ số</th>
                            <th scope="col">Trạng thái</th>
                            <th scope="col" class="actions-heading">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($lophocs as $lop)
                            <tr>
                                <td class="class-id">{{ $lop->id }}</td>
                                <td>{{ $lop->ten_lop }}</td>
                                <td><span class="class-code">{{ $lop->ma_lop }}</span></td>
                                <td>{{ $lop->giao_vien }}</td>
                                <td>{{ $lop->so_dien_thoai }}</td>
                                <td class="class-size">{{ $lop->si_so }}</td>
                                <td>
                                    <span class="status-badge {{ $lop->trang_thai === 'Hoạt động' ? 'status-active' : 'status-stopped' }}">
                                        {{ $lop->trang_thai }}
                                    </span>
                                </td>
                                <td class="actions-cell">
                                    <a href="{{ route('lophoc.show', $lop->id) }}" class="action-button action-detail">Chi tiết</a>
                                    <a href="{{ route('lophoc.edit', $lop->id) }}" class="action-button action-edit">Sửa</a>
                                    <form action="{{ route('lophoc.destroy', $lop->id) }}" method="POST" class="delete-form" onsubmit="return confirm('Bạn có chắc chắn muốn xóa?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="action-button action-delete">Xóa</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="empty-state">Chưa có dữ liệu lớp học.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{ $lophocs->links('pagination.centered') }}
    </div>
@endsection
