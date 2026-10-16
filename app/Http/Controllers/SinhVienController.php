<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSinhVienRequest;
use App\Http\Requests\UpdateSinhVienRequest;
use App\Models\LopHoc;
use App\Models\SinhVien;
use Illuminate\Http\Request;

class SinhVienController extends Controller
{
    private const SORTABLE = ['id', 'ho_ten', 'email', 'nganh', 'phone_number', 'lop_hoc_id'];

    public function index(Request $request)
    {
        $filters = $request->validate([
            'q' => ['nullable', 'string', 'max:100'],
            'nganh' => ['nullable', 'string', 'max:255'],
            'lop_hoc_id' => ['nullable', 'integer', 'exists:lop_hocs,id'],
            'per_page' => ['nullable', 'integer', 'in:5,10,25,50'],
            'sort' => ['nullable', 'in:'.implode(',', self::SORTABLE)],
            'direction' => ['nullable', 'in:asc,desc'],
        ]);
        $search = trim($filters['q'] ?? '');
        $sort = $filters['sort'] ?? 'id';
        $direction = $filters['direction'] ?? 'asc';
        $query = SinhVien::query()->with('lopHoc');

        if ($search !== '') {
            $query->where(fn ($q) => $q->where('ho_ten', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%")
                ->orWhere('nganh', 'like', "%{$search}%")
                ->orWhere('phone_number', 'like', "%{$search}%"));
        }

        $sinhviens = $query
            ->when(isset($filters['nganh']), fn ($q) => $q->where('nganh', 'like', '%'.$filters['nganh'].'%'))
            ->when(isset($filters['lop_hoc_id']), fn ($q) => $q->where('lop_hoc_id', $filters['lop_hoc_id']))
            ->orderBy($sort, $direction)
            ->orderBy('id')
            ->paginate($filters['per_page'] ?? 10)
            ->withQueryString();
        $lophocs = LopHoc::orderBy('ten_lop')->get();

        return view('sinhvien.index', compact('sinhviens', 'lophocs', 'sort', 'direction'));
    }

    public function create()
    {
        $lophocs = LopHoc::orderBy('ten_lop')->get();

        return view('sinhvien.add', compact('lophocs'));
    }

    public function store(StoreSinhVienRequest $request)
    {
        SinhVien::create($request->validated());

        return redirect()->route('sinhvien.index')->with('success', 'Thêm sinh viên thành công!');
    }

    public function show(SinhVien $sinhvien)
    {
        $sinhvien->load('lopHoc');

        return view('sinhvien.show', compact('sinhvien'));
    }

    public function edit(SinhVien $sinhvien)
    {
        $lophocs = LopHoc::orderBy('ten_lop')->get();

        return view('sinhvien.edit', compact('sinhvien', 'lophocs'));
    }

    public function update(UpdateSinhVienRequest $request, SinhVien $sinhvien)
    {
        $sinhvien->update($request->validated());

        return redirect()->route('sinhvien.index')->with('success', 'Cập nhật sinh viên thành công!');
    }

    public function destroy(SinhVien $sinhvien)
    {
        $sinhvien->delete();

        return redirect()->route('sinhvien.index')->with('success', 'Xóa sinh viên thành công!');
    }
}
