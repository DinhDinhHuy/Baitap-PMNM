<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SinhVienController extends Controller
{
    private $sinhvien = [
        ['id' => 1, 'name' => 'Nguyễn Văn A', 'email' => 'nguyenvana@example.com', 'nganh' => 'Công nghệ thông tin'],
        ['id' => 2, 'name' => 'Trần Thị B', 'email' => 'tranthib@example.com', 'nganh' => 'Thiết kế đồ họa'],
        ['id' => 3, 'name' => 'Lê Văn C', 'email' => 'levanc@example.com', 'nganh' => 'Quản trị kinh doanh'],
    ];

    public function index(Request $request) {
        $validated = $request->validate([
            'q' => 'nullable|string|max:100',
        ]);
        $search = trim($validated['q'] ?? '');

        $query = \App\Models\SinhVien::query();

        if ($search !== '') {
            $query->where(function ($query) use ($search) {
                $query->where('ho_ten', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('nganh', 'like', "%{$search}%")
                    ->orWhere('phone_number', 'like', "%{$search}%");
            });
        }

        $sinhviens = $query->paginate(5)->withQueryString();

        return view('sinhvien.index', compact('sinhviens'));
    }

    public function add() {
        return view('sinhvien.add');
    }



    public function show($id = "") {
        $sinhvien = \App\Models\SinhVien::findOrFail($id);

        return view('sinhvien.show', compact('sinhvien'));
    }

    public function showInfo($hoten= "Chưa có tên", $tuoi=0) {
        return "Tên sinh viên là: " . $hoten . ", Tuổi: " . $tuoi;
    }
    public function getID($id="") {
        $sinhvien = collect($this->sinhvien)->firstWhere('id', (int)$id);


        return " Thông tin sinh viên có id là ". $id . " là: ". $sinhvien['name'] . " - ". $sinhvien['nganh'];
    }
    public function store(Request $request){
        // Validate request (optional nhưng nên có)
        $request->validate([
            'ho_ten' => 'required',
            'email' => 'required|email',
            'nganh' => 'required',
            'phone_number' => 'required'
        ]);

        // Tạo mới sinh viên (SinhVien)
        \App\Models\SinhVien::create($request->all());
        
        // Chuyển hướng về trang danh sách (hoặc đâu đó)
        return redirect()->route('sinhvien.index')->with('success', 'Thêm sinh viên thành công!');
    }
    public function create(Request $request){
        return view('sinhvien.add');
    }





}