<aside class="content-sidebar">
    <ul class="sidebar-menu-list">
        @if ($menus->isEmpty())
            <li class="{{ request()->routeIs('sinhvien.index') ? 'active' : '' }}">
                <a href="{{ route('sinhvien.index') }}"><i class="fas fa-user-graduate"></i> Danh sách sinh viên</a>
            </li>
            <li class="{{ request()->routeIs('sinhvien.add') ? 'active' : '' }}">
                <a href="{{ route('sinhvien.add') }}"><i class="fas fa-chevron-right"></i> Thêm sinh viên</a>
            </li>
            <li class="{{ request()->routeIs('lophoc.*') ? 'active' : '' }}">
                <a href="{{ route('lophoc.index') }}"><i class="fas fa-chalkboard"></i> Quản lý lớp học</a>
            </li>
            <li><a href="#"><i class="fas fa-chevron-right"></i> Điểm danh</a></li>
            <li><a href="#"><i class="fas fa-chevron-right"></i> Kết quả học tập</a></li>
        @else
            @foreach ($menus->groupBy('nhom') as $nhom => $nhomMenus)
                @if ($nhom)
                    <li class="sidebar-menu-heading" style="padding: 10px 15px 5px; color: #64748b; font-size: 12px; font-weight: 700; text-transform: uppercase;">
                        {{ $nhom }}
                    </li>
                @endif
                @foreach ($nhomMenus as $menu)
                    <li class="{{ $menu->dangChon() ? 'active' : '' }}">
                        <a href="{{ $menu->url }}" @if ($menu->dangChon()) aria-current="page" @endif>
                            <i class="fas fa-chevron-right"></i> {{ $menu->ten }}
                        </a>
                    </li>
                @endforeach
            @endforeach
        @endif
    </ul>
</aside>
