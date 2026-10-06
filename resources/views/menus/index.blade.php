@extends('layouts.admin')

@section('title', 'Quản lý menu')

@push('styles')
    <style>
        .menu-list-page .page-heading {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            margin-bottom: 24px;
        }

        .menu-list-page .page-title {
            margin-bottom: 4px;
        }

        .menu-list-page .page-subtitle {
            color: #64748b;
            font-size: 14px;
        }

        .menu-list-page .add-menu-button,
        .menu-list-page .menu-action {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            min-height: 36px;
            padding: 8px 12px;
            border: 1px solid transparent;
            border-radius: 7px;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            transition: background-color .15s, border-color .15s, transform .15s;
        }

        .menu-list-page .add-menu-button {
            min-height: 42px;
            padding: 11px 16px;
            border-radius: 8px;
            background: #0875e1;
            box-shadow: 0 4px 10px rgb(8 117 225 / 18%);
            color: #fff;
            font-size: 14px;
            white-space: nowrap;
            transition: background-color .2s, box-shadow .2s, transform .2s;
        }

        .menu-list-page .add-menu-button:hover {
            background: #0563c2;
            box-shadow: 0 6px 14px rgb(8 117 225 / 24%);
            transform: translateY(-1px);
        }

        .menu-list-page .filter-panel {
            margin-bottom: 18px;
            padding: 16px;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            background: #fff;
            box-shadow: 0 3px 12px rgb(15 23 42 / 4%);
        }

        .menu-list-page .filter-grid {
            display: grid;
            grid-template-columns: minmax(200px, 2fr) repeat(3, minmax(125px, 1fr));
            gap: 12px;
            align-items: end;
        }

        .menu-list-page .filter-field {
            min-width: 0;
        }

        .menu-list-page .filter-field label {
            display: block;
            margin-bottom: 5px;
            color: #334155;
            font-size: 13px;
            font-weight: 600;
        }

        .menu-list-page .filter-field input,
        .menu-list-page .filter-field select {
            width: 100%;
            min-height: 40px;
            padding: 8px 10px;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            background: #fff;
            color: #1e293b;
            font-size: 14px;
        }

        .menu-list-page .filter-field input:focus,
        .menu-list-page .filter-field select:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 2px rgb(59 130 246 / 15%);
            outline: 0;
        }

        .menu-list-page .filter-actions {
            display: flex;
            grid-column: 1 / -1;
            gap: 8px;
        }

        .menu-list-page .filter-submit,
        .menu-list-page .filter-clear {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 36px;
            padding: 7px 12px;
            border: 1px solid transparent;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
        }

        .menu-list-page .filter-submit {
            background: #0875e1;
            color: #fff;
        }

        .menu-list-page .filter-clear {
            border-color: #cbd5e1;
            background: #fff;
            color: #475569;
        }

        .menu-list-page .filter-submit:hover {
            background: #0563c2;
        }

        .menu-list-page .filter-clear:hover {
            background: #f1f5f9;
        }

        .menu-list-page .menu-result-count {
            margin-bottom: 12px;
            color: #64748b;
            font-size: 14px;
        }

        .menu-list-page .menu-result-count strong {
            color: #0f172a;
        }

        .menu-list-page .table-card {
            overflow: hidden;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            background: #fff;
            box-shadow: 0 4px 16px rgb(15 23 42 / 5%);
        }

        .menu-list-page .table-scroll {
            overflow-x: auto;
        }

        .menu-list-page .menu-table {
            width: 100%;
            min-width: 800px;
            border-collapse: separate;
            border-spacing: 0;
            text-align: left;
        }

        .menu-list-page .menu-table th {
            padding: 13px 14px;
            background: #f1f5f9;
            color: #334155;
            font-size: 13px;
            font-weight: 700;
            white-space: nowrap;
        }

        .menu-list-page .menu-table th a {
            color: inherit;
            text-decoration: none;
        }

        .menu-list-page .menu-table th a:hover {
            color: #0875e1;
        }

        .menu-list-page .menu-table td {
            padding: 13px 14px;
            border-top: 1px solid #edf1f5;
            color: #334155;
            font-size: 14px;
            vertical-align: middle;
        }

        .menu-list-page .menu-table tbody tr {
            transition: background-color .15s;
        }

        .menu-list-page .menu-table tbody tr:hover {
            background: #f8fbff;
        }

        .menu-list-page .menu-id {
            color: #64748b !important;
            font-variant-numeric: tabular-nums;
        }

        .menu-list-page .menu-url {
            color: #1d4ed8;
            overflow-wrap: anywhere;
        }

        .menu-list-page .menu-badge {
            display: inline-block;
            padding: 4px 9px;
            border-radius: 999px;
            background: #eff6ff;
            color: #1d4ed8;
            font-size: 12px;
            font-weight: 600;
            white-space: nowrap;
        }

        .menu-list-page .status-visible {
            border-radius: 5px;
            background: #388b57;
            color: #fff;
        }

        .menu-list-page .status-hidden {
            border-radius: 5px;
            background: #737d88;
            color: #fff;
        }

        .menu-list-page .menu-actions {
            text-align: center;
            white-space: nowrap;
        }

        .menu-list-page .menu-action-edit {
            border-radius: 6px;
            border-color: #cbd5e1;
            background: #fff;
            color: #334155;
        }

        .menu-list-page .menu-action-edit:hover {
            background: #f1f5f9;
        }

        .menu-list-page .menu-action-delete {
            border-radius: 6px;
            border-color: #fecaca;
            background: #fff;
            color: #b91c1c;
        }

        .menu-list-page .menu-action-delete:hover {
            background: #fef2f2;
        }

        .menu-list-page .empty-state {
            padding: 32px 16px !important;
            color: #64748b !important;
            text-align: center;
        }

        .menu-list-page .pagination-wrapper {
            margin-top: 22px;
        }

        .menu-list-page .filter-submit:focus-visible,
        .menu-list-page .filter-clear:focus-visible,
        .menu-list-page .add-menu-button:focus-visible,
        .menu-list-page .menu-action:focus-visible,
        .menu-list-page .menu-table th a:focus-visible,
        .menu-list-page .page-link:focus-visible {
            outline: 3px solid #93c5fd;
            outline-offset: 2px;
        }

        @media (max-width: 1000px) {
            .menu-list-page .filter-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 700px) {
            .menu-list-page .page-heading {
                align-items: flex-start;
                flex-direction: column;
            }

            .menu-list-page .filter-grid {
                grid-template-columns: 1fr;
            }

            .menu-list-page .filter-actions {
                grid-column: auto;
            }
        }
    </style>
@endpush

@section('content')
    @include('partials.sidebar')

    <div class="main-content menu-list-page">
        <div class="page-heading">
            <div>
                <h1 class="page-title">Quản lý menu</h1>
                <p class="page-subtitle">Tạo và sắp xếp các liên kết hiển thị trên header hoặc sidebar.</p>
            </div>
            <a href="{{ route('menu.create') }}" class="add-menu-button">
                <i class="fas fa-plus" aria-hidden="true"></i>
                Thêm menu
            </a>
        </div>

        @if (session('success'))
            <div class="alert-success" role="status">{{ session('success') }}</div>
        @endif

        <form action="{{ route('menu.index') }}" method="GET" class="filter-panel">
            <input type="hidden" name="sort" value="{{ $sort }}">
            <input type="hidden" name="direction" value="{{ $direction }}">

            <div class="filter-grid">
                <div class="filter-field">
                    <label for="keyword">Từ khóa</label>
                    <input type="search" id="keyword" name="keyword"
                           placeholder="Tên menu, đường dẫn, nhóm..."
                           value="{{ $filters['keyword'] ?? '' }}">
                </div>
                <div class="filter-field">
                    <label for="vi_tri">Vị trí</label>
                    <select id="vi_tri" name="vi_tri">
                        <option value="">Tất cả vị trí</option>
                        @foreach (\App\Models\Menu::VI_TRI as $giaTri => $nhan)
                            <option value="{{ $giaTri }}" @selected(($filters['vi_tri'] ?? '') === $giaTri)>{{ $nhan }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="filter-field">
                    <label for="trang_thai">Trạng thái</label>
                    <select id="trang_thai" name="trang_thai">
                        <option value="">Tất cả trạng thái</option>
                        <option value="1" @selected(($filters['trang_thai'] ?? '') === '1')>Hiển thị</option>
                        <option value="0" @selected(($filters['trang_thai'] ?? '') === '0')>Ẩn</option>
                    </select>
                </div>
                <div class="filter-field">
                    <label for="perPage">Số dòng mỗi trang</label>
                    <select id="perPage" name="perPage" onchange="this.form.submit()">
                        @foreach ($perPageOptions as $option)
                            <option value="{{ $option }}" @selected($perPage === $option)>{{ $option }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="filter-actions">
                    <button type="submit" class="filter-submit">
                        <i class="fas fa-filter" aria-hidden="true"></i>
                        Lọc
                    </button>
                    <a href="{{ route('menu.index') }}" class="filter-clear">Xóa lọc</a>
                </div>
            </div>
        </form>

        <p class="menu-result-count">Tìm thấy <strong>{{ $menus->total() }}</strong> menu.</p>

        @php
            $columns = [
                'id' => 'ID',
                'ten' => 'Tên menu',
                'url' => 'Đường dẫn',
                'vi_tri' => 'Vị trí',
                'nhom' => 'Nhóm',
                'thu_tu' => 'Thứ tự',
                'trang_thai' => 'Trạng thái',
            ];
        @endphp

        <div class="table-card">
            <div class="table-scroll">
                <table class="menu-table">
                    <thead>
                        <tr>
                            @foreach ($columns as $column => $label)
                                <th scope="col">
                                    @if (in_array($column, $sortable))
                                        <a href="{{ request()->fullUrlWithQuery([
                                            'sort' => $column,
                                            'direction' => $sort === $column && $direction === 'asc' ? 'desc' : 'asc',
                                            'page' => null,
                                        ]) }}" aria-label="Sắp xếp theo {{ $label }}">
                                            {{ $label }}
                                            @if ($sort === $column)
                                                <span aria-hidden="true">{{ $direction === 'asc' ? '▲' : '▼' }}</span>
                                            @endif
                                        </a>
                                    @else
                                        {{ $label }}
                                    @endif
                                </th>
                            @endforeach
                            <th scope="col" class="menu-actions">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($menus as $menu)
                            <tr>
                                <td class="menu-id">{{ $menu->id }}</td>
                                <td><strong>{{ $menu->ten }}</strong></td>
                                <td><code class="menu-url">{{ $menu->url }}</code></td>
                                <td><span class="menu-badge">{{ \App\Models\Menu::VI_TRI[$menu->vi_tri] ?? $menu->vi_tri }}</span></td>
                                <td>{{ $menu->nhom ?: '—' }}</td>
                                <td>{{ $menu->thu_tu }}</td>
                                <td>
                                    <span class="menu-badge {{ $menu->trang_thai ? 'status-visible' : 'status-hidden' }}">
                                        {{ $menu->trang_thai ? 'Hiển thị' : 'Ẩn' }}
                                    </span>
                                </td>
                                <td class="menu-actions">
                                    <a href="{{ route('menu.edit', $menu) }}" class="menu-action menu-action-edit">
                                        <i class="fas fa-pen" aria-hidden="true"></i> Sửa
                                    </a>
                                    <form action="{{ route('menu.destroy', $menu) }}" method="POST" style="display: inline;"
                                          onsubmit="return confirm('Bạn có chắc chắn muốn xóa menu này không?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="menu-action menu-action-delete">
                                            <i class="fas fa-trash" aria-hidden="true"></i> Xóa
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="{{ count($columns) + 1 }}" class="empty-state">Không có menu nào phù hợp.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="pagination-wrapper">
            {{ $menus->links() }}
        </div>
    </div>
@endsection
