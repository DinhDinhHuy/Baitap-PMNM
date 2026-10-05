<aside class="content-sidebar">
    <ul class="sidebar-menu-list">
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
    </ul>
</aside>
