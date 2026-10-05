<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Bước 2: Hiển thị form đăng nhập (View)
    public function login()
    {
        return view('auth.login');
    }

    // Bước 2: Xử lý logic đăng nhập khi bấm nút
    public function authenticate(Request $request)
    {
        // Kiểm tra dữ liệu nhập vào
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Auth::attempt sẽ tự động so sánh email/password với database (Model User)
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            // Đăng nhập thành công thì chuyển hướng vào trang Sinh Viên
            return redirect()->intended('/sinhvien');
        }

        // Đăng nhập thất bại thì quay lại báo lỗi
        return back()->withErrors([
            'email' => 'Email hoặc mật khẩu không chính xác.',
        ])->onlyInput('email');
    }

    // Xử lý đăng xuất
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
