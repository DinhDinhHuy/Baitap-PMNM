<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLopHocRequest;
use App\Http\Requests\UpdateLopHocRequest;
use App\Models\LopHoc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LopHocController extends Controller
{
    private const SORTABLE = ['id', 'ten_lop', 'ma_lop', 'giao_vien', 'si_so', 'trang_thai'];

    public function index(Request $request)
    {
        $validator = Validator::make($request->query(), [
            'q' => ['nullable', 'string', 'max:100'],
            'trang_thai' => ['nullable', 'in:Hoạt động,Ngừng'],
            'si_so_tu' => ['nullable', 'integer', 'min:0'],
            'si_so_den' => ['nullable', 'integer', 'min:0'],
            'per_page' => ['nullable', 'integer', 'in:5,10,25,50'],
            'sort' => ['nullable', 'in:'.implode(',', self::SORTABLE)],
            'direction' => ['nullable', 'in:asc,desc'],
        ]);
        $validator->after(function ($validator) use ($request) {
            $from = $request->query('si_so_tu');
            $to = $request->query('si_so_den');
            if (is_numeric($from) && is_numeric($to) && (int) $from > (int) $to) {
                $validator->errors()->add('si_so_tu', 'Sĩ số từ phải nhỏ hơn hoặc bằng sĩ số đến.');
            }
        });
        $filters = $validator->validate();

        $search = trim($filters['q'] ?? '');
        $sort = $filters['sort'] ?? 'id';
        $direction = $filters['direction'] ?? 'asc';
        $query = LopHoc::query();

        if ($search !== '') {
            $query->where(fn ($q) => $q->where('ten_lop', 'like', "%{$search}%")
                ->orWhere('ma_lop', 'like', "%{$search}%")
                ->orWhere('giao_vien', 'like', "%{$search}%"));
        }

        $query->when(isset($filters['trang_thai']), fn ($q) => $q->where('trang_thai', $filters['trang_thai']))
            ->when(isset($filters['si_so_tu']), fn ($q) => $q->where('si_so', '>=', $filters['si_so_tu']))
            ->when(isset($filters['si_so_den']), fn ($q) => $q->where('si_so', '<=', $filters['si_so_den']));

        $lophocs = $query->orderBy($sort, $direction)->orderBy('id')->paginate($filters['per_page'] ?? 10)->withQueryString();

        return view('lophoc.index', compact('lophocs', 'sort', 'direction'));
    }

    public function create()
    {
        return view('lophoc.create', ['lophoc' => new LopHoc]);
    }

    public function store(StoreLopHocRequest $request)
    {
        LopHoc::create($request->validated());

        return redirect()->route('lophoc.index')->with('success', 'Thêm mới thành công!');
    }

    public function show(LopHoc $lophoc)
    {
        return view('lophoc.show', compact('lophoc'));
    }

    public function edit(LopHoc $lophoc)
    {
        return view('lophoc.edit', compact('lophoc'));
    }

    public function update(UpdateLopHocRequest $request, LopHoc $lophoc)
    {
        $lophoc->update($request->validated());

        return redirect()->route('lophoc.index')->with('success', 'Cập nhật thành công!');
    }

    public function destroy(LopHoc $lophoc)
    {
        $lophoc->delete();

        return redirect()->route('lophoc.index')->with('success', 'Xóa thành công!');
    }
}
