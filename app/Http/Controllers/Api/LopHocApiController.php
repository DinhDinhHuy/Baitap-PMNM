<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLopHocRequest;
use App\Http\Requests\UpdateLopHocRequest;
use App\Models\LopHoc;
use Illuminate\Http\Request;

class LopHocApiController extends Controller
{
    public function index(Request $request)
    {
        $filters = $request->validate([
            'q' => ['nullable', 'string', 'max:100'],
            'trang_thai' => ['nullable', 'in:Hoạt động,Ngừng'],
            'sort' => ['nullable', 'in:id,ten_lop,ma_lop,giao_vien,si_so,trang_thai'],
            'direction' => ['nullable', 'in:asc,desc'],
            'per_page' => ['nullable', 'integer', 'min:1', 'max:100'],
        ]);

        $query = LopHoc::query()
            ->when(isset($filters['q']), fn ($q) => $q->where(fn ($q) => $q->where('ten_lop', 'like', '%'.$filters['q'].'%')->orWhere('ma_lop', 'like', '%'.$filters['q'].'%')->orWhere('giao_vien', 'like', '%'.$filters['q'].'%')))
            ->when(isset($filters['trang_thai']), fn ($q) => $q->where('trang_thai', $filters['trang_thai']))
            ->orderBy($filters['sort'] ?? 'id', $filters['direction'] ?? 'asc');

        return $query->paginate($filters['per_page'] ?? 15);
    }

    public function store(StoreLopHocRequest $request)
    {
        return response()->json(LopHoc::create($request->validated()), 201);
    }

    public function show(LopHoc $lophoc)
    {
        return $lophoc->load('sinhViens');
    }

    public function update(UpdateLopHocRequest $request, LopHoc $lophoc)
    {
        $lophoc->update($request->validated());

        return response()->json($lophoc);
    }

    public function destroy(LopHoc $lophoc)
    {
        $lophoc->delete();

        return response()->noContent();
    }
}
