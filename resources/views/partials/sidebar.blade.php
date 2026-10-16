<aside class="content-sidebar">
    <div style="background: #fff; border: 1px solid #e2e8f0; border-radius: 10px; overflow: hidden; box-shadow: 0 4px 16px rgba(15, 23, 42, 0.04);">
        <ul class="sidebar-menu-list" style="margin: 0; padding: 0; border: 0;">

            <li class="sidebar-menu-heading" style="padding: 14px 16px 6px; color: #94a3b8; font-size: 11px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.6px; border: 0;">
                <i class="fas fa-graduation-cap" style="margin-right: 5px;"></i> Quản lý đào tạo
            </li>
            <li class="{{ request()->routeIs('lophoc.*') ? 'active' : '' }}">
                <a href="{{ route('lophoc.index') }}"><i class="fas fa-chalkboard"></i> Quản lý lớp học</a>
            </li>
            <li class="{{ request()->routeIs('sinhvien.*') ? 'active' : '' }}">
                <a href="{{ route('sinhvien.index') }}"><i class="fas fa-user-graduate"></i> Quản lý sinh viên</a>
            </li>
 
            @if (auth()->user()?->isAdmin())
                <li class="sidebar-menu-heading" style="padding: 16px 16px 6px; color: #94a3b8; font-size: 11px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.6px; border-top: 1px solid #f1f5f9;">
                    <i class="fas fa-cogs" style="margin-right: 5px;"></i> Quản trị hệ thống
                </li>
                <li class="{{ request()->routeIs('menu.*') ? 'active' : '' }}">
                    <a href="{{ route('menu.index') }}"><i class="fas fa-bars"></i> Quản lý menu</a>
                </li>
                <li class="{{ request()->routeIs('users.*') ? 'active' : '' }}">
                    <a href="{{ route('users.index') }}"><i class="fas fa-users-cog"></i> Quản lý tài khoản</a>
                </li>
            @endif

            <!-- Nhóm 3: Menu tùy biến từ Database (nếu tạo thêm trong Quản lý menu) -->
            @php
                $customMenus = $menus->reject(function ($m) {
                    return in_array($m->url, ['/lophoc', '/sinhvien', '/menu', '/users', '/account'], true);
                });
            @endphp

            @if ($customMenus->isNotEmpty())
                @foreach ($customMenus->groupBy('nhom') as $nhom => $nhomMenus)
                    <li class="sidebar-menu-heading" style="padding: 16px 16px 6px; color: #94a3b8; font-size: 11px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.6px; border-top: 1px solid #f1f5f9;">
                        <i class="fas fa-folder" style="margin-right: 5px;"></i> {{ $nhom ?: 'Liên kết khác' }}
                    </li>
                    @foreach ($nhomMenus as $menu)
                        @if (auth()->user()?->isAdmin() || ! in_array($menu->url, ['/menu', '/users'], true))
                            <li class="{{ $menu->dangChon() ? 'active' : '' }}">
                                <a href="{{ $menu->url }}" @if ($menu->dangChon()) aria-current="page" @endif>
                                    <i class="fas fa-link"></i> {{ $menu->ten }}
                                </a>
                            </li>
                        @endif
                    @endforeach
                @endforeach
            @endif

            <!-- Nhóm 4: Tài khoản cá nhân -->
            <li class="sidebar-menu-heading" style="padding: 16px 16px 6px; color: #94a3b8; font-size: 11px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.6px; border-top: 1px solid #f1f5f9;">
                <i class="fas fa-user" style="margin-right: 5px;"></i> Cá nhân
            </li>
            <li class="{{ request()->routeIs('account.*') ? 'active' : '' }}">
                <a href="{{ route('account.edit') }}"><i class="fas fa-user-cog"></i> Tài khoản của tôi</a>
            </li>
        </ul>
    </div>
</aside>
