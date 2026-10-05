<?php

namespace App\Http\Controllers;

use App\Models\LopHoc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LopHocController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $validator = Validator::make($request->query(), [
            'q' => 'nullable|string|max:100',
            'trang_thai' => 'nullable|in:Hoạt động,Ngừng',
            'si_so_tu' => 'nullable|integer|min:0',
            'si_so_den' => 'nullable|integer|min:0',
            'per_page' => 'nullable|integer|in:5,10,25,50',
        ], [
            'q.string' => 'Từ khóa tìm kiếm không hợp lệ.',
            'q.max' => 'Từ khóa tìm kiếm không được vượt quá 100 ký tự.',
            'trang_thai.in' => 'Trạng thái lớp học không hợp lệ.',
            'si_so_tu.integer' => 'Sĩ số từ phải là số nguyên.',
            'si_so_tu.min' => 'Sĩ số từ không được nhỏ hơn 0.',
            'si_so_den.integer' => 'Sĩ số đến phải là số nguyên.',
            'si_so_den.min' => 'Sĩ số đến không được nhỏ hơn 0.',
            'per_page.integer' => 'Số dòng mỗi trang không hợp lệ.',
            'per_page.in' => 'Số dòng mỗi trang phải là 5, 10, 25 hoặc 50.',
        ]);
        $validator->after(function ($validator) use ($request) {
            $from = $request->query('si_so_tu');
            $to = $request->query('si_so_den');

            if (is_numeric($from) && is_numeric($to) && (int) $from > (int) $to) {
                $validator->errors()->add('si_so_tu', 'Sĩ số từ phải nhỏ hơn hoặc bằng sĩ số đến.');
            }
        });

        $validated = $validator->validate();
        $search = trim($validated['q'] ?? '');

        $query = LopHoc::query();

        if ($search !== '') {
            $query->where(function ($query) use ($search) {
                $query->where('ten_lop', 'like', "%{$search}%")
                    ->orWhere('ma_lop', 'like', "%{$search}%")
                    ->orWhere('giao_vien', 'like', "%{$search}%");
            });
        }

        if (isset($validated['trang_thai'])) {
            $query->where('trang_thai', $validated['trang_thai']);
        }

        if (isset($validated['si_so_tu'])) {
            $query->where('si_so', '>=', $validated['si_so_tu']);
        }

        if (isset($validated['si_so_den'])) {
            $query->where('si_so', '<=', $validated['si_so_den']);
        }

        $perPage = (int) ($validated['per_page'] ?? 10);
        $lophocs = $query->paginate($perPage)->withQueryString();

        return view('lophoc.index', compact('lophocs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('lophoc.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'ten_lop' => 'required',
            'ma_lop' => 'required',
            'giao_vien' => 'required',
            'so_dien_thoai' => 'required',
            'ghi_chu' => 'nullable',
            'si_so' => 'required|integer|min:0',
            'trang_thai' => 'required|in:Hoạt động,Ngừng',
        ]);

        LopHoc::create($validated);
        
        return redirect()->route('lophoc.index')->with('success', 'Thêm mới thành công!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $lophoc = LopHoc::findOrFail($id);
        return view('lophoc.show', compact('lophoc'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $lophoc = LopHoc::findOrFail($id);
        return view('lophoc.edit', compact('lophoc'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'ten_lop' => 'required',
            'ma_lop' => 'required',
            'giao_vien' => 'required',
            'so_dien_thoai' => 'required',
            'ghi_chu' => 'nullable',
            'si_so' => 'required|integer|min:0',
            'trang_thai' => 'required|in:Hoạt động,Ngừng',
        ]);

        $lophoc = LopHoc::findOrFail($id);
        $lophoc->update($validated);

        return redirect()->route('lophoc.index')->with('success', 'Cập nhật thành công!');
    }

    /**
     * Remove the specified resource from storage. 
     */
    public function destroy(string $id)
    {
        $lophoc = LopHoc::findOrFail($id);
        $lophoc->delete();

        return redirect()->route('lophoc.index')->with('success', 'Xóa thành công!');
    }
}
