@php($editing = isset($lophoc) && $lophoc->exists)
<div style="max-width:600px">
    <form method="POST" action="{{ $editing ? route('lophoc.update', $lophoc) : route('lophoc.store') }}">
        @csrf
        @if ($editing) @method('PUT') @endif
        @foreach (['ten_lop' => 'Tên lớp', 'ma_lop' => 'Mã lớp', 'giao_vien' => 'Giáo viên', 'so_dien_thoai' => 'Số điện thoại'] as $field => $label)
            <div style="margin-bottom:15px">
                <label for="{{ $field }}">{{ $label }}</label>
                <input id="{{ $field }}" name="{{ $field }}" value="{{ old($field, $lophoc?->$field) }}" required maxlength="255" style="display:block;width:100%;padding:9px">
            </div>
        @endforeach
        <div style="margin-bottom:15px">
            <label for="ghi_chu">Ghi chú</label>
            <textarea id="ghi_chu" name="ghi_chu" style="display:block;width:100%;padding:9px">{{ old('ghi_chu', $lophoc?->ghi_chu) }}</textarea>
        </div>
        <div style="margin-bottom:15px">
            <label for="si_so">Sĩ số</label>
            <input id="si_so" type="number" name="si_so" min="0" value="{{ old('si_so', $lophoc?->si_so ?? 0) }}" required style="display:block;width:100%;padding:9px">
        </div>
        <div style="margin-bottom:15px">
            <label for="trang_thai">Trạng thái</label>
            <select id="trang_thai" name="trang_thai" required style="display:block;width:100%;padding:9px">
                <option value="Hoạt động" @selected(old('trang_thai', $lophoc?->trang_thai ?? 'Hoạt động') === 'Hoạt động')>Hoạt động</option>
                <option value="Ngừng" @selected(old('trang_thai', $lophoc?->trang_thai) === 'Ngừng')>Ngừng</option>
            </select>
        </div>
        <button type="submit" class="list-search-button">{{ $editing ? 'Cập nhật' : 'Lưu lớp học' }}</button>
        <a href="{{ route('lophoc.index') }}" class="list-search-clear">Hủy</a>
    </form>
</div>
