@php($menu = $menu ?? null)

@php($menu = $menu ?? null)

<div class="form-grid">
    <div class="menu-field">
        <label for="ten">Tên menu <span class="required-mark">*</span></label>
        <input type="text" id="ten" name="ten" maxlength="100" required
               class="@error('ten') is-invalid @enderror"
               value="{{ old('ten', $menu?->ten) }}"
               aria-invalid="@error('ten') true @else false @enderror">
        @error('ten')
            <p class="field-error">{{ $message }}</p>
        @enderror
    </div>

    <div class="menu-field">
        <label for="url">Đường dẫn <span class="required-mark">*</span></label>
        <input type="text" id="url" name="url" maxlength="255" required
               class="@error('url') is-invalid @enderror"
               value="{{ old('url', $menu?->url) }}"
               aria-invalid="@error('url') true @else false @enderror">
        <p class="field-help">Ví dụ: <code>/lophoc</code>, <code>#</code> hoặc <code>https://huce.edu.vn</code>.</p>
        @error('url')
            <p class="field-error">{{ $message }}</p>
        @enderror
    </div>

    <div class="menu-field">
        <label for="vi_tri">Vị trí hiển thị <span class="required-mark">*</span></label>
        <select id="vi_tri" name="vi_tri" required
                class="@error('vi_tri') is-invalid @enderror"
                aria-invalid="@error('vi_tri') true @else false @enderror">
            <option value="">-- Chọn vị trí --</option>
            @foreach (\App\Models\Menu::VI_TRI as $giaTri => $nhan)
                <option value="{{ $giaTri }}" @selected(old('vi_tri', $menu?->vi_tri) === $giaTri)>{{ $nhan }}</option>
            @endforeach
        </select>
        @error('vi_tri')
            <p class="field-error">{{ $message }}</p>
        @enderror
    </div>

    <div class="menu-field">
        <label for="nhom">Nhóm</label>
        <input type="text" id="nhom" name="nhom" maxlength="100"
               class="@error('nhom') is-invalid @enderror"
               value="{{ old('nhom', $menu?->nhom) }}"
               aria-invalid="@error('nhom') true @else false @enderror">
        <p class="field-help">Dùng làm tiêu đề nhóm trong sidebar; không áp dụng cho header.</p>
        @error('nhom')
            <p class="field-error">{{ $message }}</p>
        @enderror
    </div>

    <div class="menu-field">
        <label for="thu_tu">Thứ tự <span class="required-mark">*</span></label>
        <input type="number" id="thu_tu" name="thu_tu" min="0" required
               class="@error('thu_tu') is-invalid @enderror"
               value="{{ old('thu_tu', $menu?->thu_tu ?? 0) }}"
               aria-invalid="@error('thu_tu') true @else false @enderror">
        <p class="field-help">Số nhỏ được hiển thị trước.</p>
        @error('thu_tu')
            <p class="field-error">{{ $message }}</p>
        @enderror
    </div>

    <div class="menu-field">
        <label for="trang_thai">Trạng thái <span class="required-mark">*</span></label>
        <select id="trang_thai" name="trang_thai" required
                class="@error('trang_thai') is-invalid @enderror"
                aria-invalid="@error('trang_thai') true @else false @enderror">
            <option value="1" @selected((string) old('trang_thai', $menu?->trang_thai ?? 1) === '1')>Hiển thị</option>
            <option value="0" @selected((string) old('trang_thai', $menu?->trang_thai ?? 1) === '0')>Ẩn</option>
        </select>
        @error('trang_thai')
            <p class="field-error">{{ $message }}</p>
        @enderror
    </div>
</div>
