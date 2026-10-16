@extends('layouts.admin')

@section('title', 'Quản lý tài khoản')

@section('content')
    @include('partials.sidebar')
    
    <div class="main-content">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; flex-wrap: wrap; gap: 16px;">
            <div>
                <h1 class="page-title">Quản lý tài khoản</h1>
                <p style="color: #64748b; font-size: 14px; margin: 0;">Quản lý danh sách người dùng và phân quyền Admin / Giảng viên trong hệ thống.</p>
            </div>
            <a href="{{ route('users.create') }}" class="list-search-button" style="text-decoration: none; display: inline-flex; align-items: center; gap: 8px; font-weight: 600;">
                <i class="fas fa-user-plus"></i> Tạo tài khoản mới
            </a>
        </div>

        <form method="GET" action="{{ route('users.index') }}" class="list-search" style="margin-bottom: 20px;">
            <div class="list-search-controls" style="flex-wrap: wrap; gap: 10px;">
                <div style="flex: 2; min-width: 220px;">
                    <input type="search" name="q" value="{{ request('q') }}" placeholder="Tìm theo tên hoặc email...">
                </div>
                <div style="flex: 1; min-width: 150px;">
                    <select name="role">
                        <option value="">-- Tất cả vai trò --</option>
                        <option value="admin" @selected(request('role') === 'admin')>Admin (Quản trị)</option>
                        <option value="lecturer" @selected(request('role') === 'lecturer')>Giảng viên</option>
                    </select>
                </div>
                <div style="flex: 1; min-width: 120px;">
                    <select name="per_page" aria-label="Số dòng mỗi trang">
                        @foreach ([5, 10, 25, 50] as $option)
                            <option value="{{ $option }}" @selected((int) request('per_page', 10) === $option)>{{ $option }} dòng / trang</option>
                        @endforeach
                    </select>
                </div>
                <button class="list-search-button" type="submit" style="display: inline-flex; align-items: center; gap: 6px;">
                    <i class="fas fa-filter"></i> Lọc
                </button>
                @if (request()->hasAny(['q', 'role', 'per_page']))
                    <a href="{{ route('users.index') }}" class="list-search-clear">Xóa lọc</a>
                @endif
            </div>
        </form>

        <p class="list-search-results">
            Tìm thấy <strong>{{ $users->total() }}</strong> tài khoản
        </p>

        <div class="table-card">
            <div class="table-scroll">
                <table class="student-table">
                    <thead>
                        <tr>
                            <th scope="col" style="width: 70px;">
                                <a href="{{ route('users.index', array_merge(request()->query(), ['sort' => 'id', 'direction' => request('sort') === 'id' && request('direction', 'asc') === 'asc' ? 'desc' : 'asc'])) }}">
                                    ID @if (request('sort') === 'id') {{ request('direction') === 'asc' ? '↑' : '↓' }} @endif
                                </a>
                            </th>
                            <th scope="col">
                                <a href="{{ route('users.index', array_merge(request()->query(), ['sort' => 'name', 'direction' => request('sort') === 'name' && request('direction', 'asc') === 'asc' ? 'desc' : 'asc'])) }}">
                                    Họ và tên @if (request('sort') === 'name') {{ request('direction') === 'asc' ? '↑' : '↓' }} @endif
                                </a>
                            </th>
                            <th scope="col">
                                <a href="{{ route('users.index', array_merge(request()->query(), ['sort' => 'email', 'direction' => request('sort') === 'email' && request('direction', 'asc') === 'asc' ? 'desc' : 'asc'])) }}">
                                    Email đăng nhập @if (request('sort') === 'email') {{ request('direction') === 'asc' ? '↑' : '↓' }} @endif
                                </a>
                            </th>
                            <th scope="col" style="width: 140px;">
                                <a href="{{ route('users.index', array_merge(request()->query(), ['sort' => 'role', 'direction' => request('sort') === 'role' && request('direction', 'asc') === 'asc' ? 'desc' : 'asc'])) }}">
                                    Vai trò @if (request('sort') === 'role') {{ request('direction') === 'asc' ? '↑' : '↓' }} @endif
                                </a>
                            </th>
                            <th scope="col" style="width: 160px; text-align: center;">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse ($users as $user)
                        <tr>
                            <td style="color: #64748b; font-weight: 600;">#{{ $user->id }}</td>
                            <td>
                                <span style="font-weight: 600; color: #0f172a;">{{ $user->name }}</span>
                            </td>
                            <td style="color: #475569;">{{ $user->email }}</td>
                            <td>
                                {{ $user->isAdmin() ? 'Admin' : 'Giảng viên' }}
                            </td>
                            <td style="text-align: center; white-space: nowrap;">
                                <div style="display: inline-flex; gap: 6px; align-items: center;">
                                    <a href="{{ route('users.edit', $user) }}" class="btn-action-edit">
                                        <i class="fas fa-edit"></i> Sửa
                                    </a>
                                    @if (auth()->id() !== $user->id)
                                        <form method="POST" action="{{ route('users.destroy', $user) }}" style="display: inline; margin: 0;" onsubmit="return confirm('Bạn có chắc chắn muốn xóa tài khoản {{ $user->name }}?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-action-delete">
                                                <i class="fas fa-trash-alt"></i> Xóa
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="empty-state" style="padding: 36px 16px; text-align: center; color: #64748b;">
                                <i class="fas fa-user-slash" style="font-size: 32px; color: #cbd5e1; margin-bottom: 8px; display: block;"></i>
                                Chưa có tài khoản nào phù hợp với bộ lọc tìm kiếm.
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{ $users->links('pagination.centered') }}
    </div>
@endsection
