<div style="max-width: 600px;">
    <form method="POST" action="{{ $sinhvien->exists ? route('sinhvien.update', $sinhvien) : route('sinhvien.store') }}">
        @csrf
        @if ($sinhvien->exists)
            @method('PUT')
        @endif

        <div style="margin-bottom: 15px;">
            <label for="ho_ten">Họ và tên</label>
            <input id="ho_ten" name="ho_ten" value="{{ old('ho_ten', $sinhvien->ho_ten) }}" required maxlength="255" style="display:block;width:100%;padding:9px">
            @error('ho_ten') <p class="list-search-error">{{ $message }}</p> @enderror
        </div>
        <div style="margin-bottom: 15px;">
            <label for="email">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email', $sinhvien->email) }}" required maxlength="255" style="display:block;width:100%;padding:9px">
            @error('email') <p class="list-search-error">{{ $message }}</p> @enderror
        </div>
        <div style="margin-bottom: 15px;">
            <label for="nganh">Ngành học</label>
            <input id="nganh" name="nganh" value="{{ old('nganh', $sinhvien->nganh) }}" required maxlength="255" style="display:block;width:100%;padding:9px">
            @error('nganh') <p class="list-search-error">{{ $message }}</p> @enderror
        </div>
        <div style="margin-bottom: 15px;">
            <label for="phone_number">Số điện thoại</label>
            <input id="phone_number" name="phone_number" value="{{ old('phone_number', $sinhvien->phone_number) }}" required maxlength="30" style="display:block;width:100%;padding:9px">
            @error('phone_number') <p class="list-search-error">{{ $message }}</p> @enderror
        </div>
        <div style="margin-bottom: 15px;">
            <label for="lop_hoc_id">Lớp học</label>
            <select id="lop_hoc_id" name="lop_hoc_id" style="display:block;width:100%;padding:9px">
                <option value="">Chưa xếp lớp</option>
                @foreach ($lophocs as $lop)
                    <option value="{{ $lop->id }}" @selected((string) old('lop_hoc_id', $sinhvien->lop_hoc_id) === (string) $lop->id)>{{ $lop->ten_lop }} ({{ $lop->ma_lop }})</option>
                @endforeach
            </select>
            @error('lop_hoc_id') <p class="list-search-error">{{ $message }}</p> @enderror
        </div>
        <button type="submit" class="list-search-button">{{ $sinhvien->exists ? 'Cập nhật' : 'Lưu sinh viên' }}</button>
        <a href="{{ route('sinhvien.index') }}" class="list-search-clear">Hủy</a>
    </form>
</div>
