<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSinhVienRequest;
use App\Http\Requests\UpdateSinhVienRequest;
use App\Models\SinhVien;
use Illuminate\Http\Request;

class SinhVienApiController extends Controller
{
    public function index(Request $request)
    {
        $filters = $request->validate([
            'q' => ['nullable', 'string', 'max:100'],
            'lop_hoc_id' => ['nullable', 'integer', 'exists:lop_hocs,id'],
            'sort' => ['nullable', 'in:id,ho_ten,email,nganh,phone_number,lop_hoc_id'],
            'direction' => ['nullable', 'in:asc,desc'],
            'per_page' => ['nullable', 'integer', 'min:1', 'max:100'],
        ]);

        return SinhVien::query()->with('lopHoc')
            ->when(isset($filters['q']), fn ($q) => $q->where(fn ($q) => $q->where('ho_ten', 'like', '%'.$filters['q'].'%')->orWhere('email', 'like', '%'.$filters['q'].'%')->orWhere('nganh', 'like', '%'.$filters['q'].'%')->orWhere('phone_number', 'like', '%'.$filters['q'].'%')))
            ->when(isset($filters['lop_hoc_id']), fn ($q) => $q->where('lop_hoc_id', $filters['lop_hoc_id']))
            ->orderBy($filters['sort'] ?? 'id', $filters['direction'] ?? 'asc')
            ->paginate($filters['per_page'] ?? 15);
    }

    public function store(StoreSinhVienRequest $request)
    {
        return response()->json(SinhVien::create($request->validated())->load('lopHoc'), 201);
    }

    public function show(SinhVien $sinhvien)
    {
        return $sinhvien->load('lopHoc');
    }

    public function update(UpdateSinhVienRequest $request, SinhVien $sinhvien)
    {
        $sinhvien->update($request->validated());

        return response()->json($sinhvien->load('lopHoc'));
    }

    public function destroy(SinhVien $sinhvien)
    {
        $sinhvien->delete();

        return response()->noContent();
    }
}
