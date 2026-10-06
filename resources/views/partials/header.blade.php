<header>
    <div class="top-header" style="background-color: #012b5d; color: #fff; padding: 15px 0;">
        <div style="max-width: 1200px; margin: 0 auto; display: flex; justify-content: space-between; align-items: center; padding: 0 15px;">
            <div class="logo-area" style="display: flex; align-items: center; gap: 15px;">
                <div style="width: 50px; height: 50px; border: 1px solid #fff; display: flex; align-items: center; justify-content: center; font-weight: bold; font-size: 16px; padding: 5px; text-align: center; line-height: 1;">
                    <i class="fas fa-building" style="font-size: 24px;"></i>
                </div>
                <div>
                    <div style="font-size: 18px; font-weight: 700; text-transform: uppercase;">Trường Đại học Xây dựng Hà Nội</div>
                    <div style="font-size: 14px; opacity: 0.9;">Hanoi University of Civil Engineering</div>
                </div>
            </div>
            @if ($menus->isNotEmpty())
                <nav aria-label="Menu chính" style="display: flex; align-items: center; justify-content: flex-end; flex-wrap: wrap; gap: 20px;">
                    @foreach ($menus as $menu)
                        <a href="{{ $menu->url }}" @if ($menu->dangChon()) aria-current="page" @endif
                           style="color: #fff; text-decoration: none;">{{ $menu->ten }}</a>
                    @endforeach
                </nav>
            @endif
        </div>
    </div>
    

    

</header>
