<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f4f7f6; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .login-box { background: white; padding: 40px; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); width: 100%; max-width: 400px; }
        .login-box h2 { text-align: center; color: #333; margin-bottom: 30px; font-weight: 800;}
        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; margin-bottom: 8px; color: #666; font-weight: bold; }
        .form-group input { width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 6px; box-sizing: border-box; font-size: 15px;}
        .form-group input:focus { border-color: #007bff; outline: none; }
        .btn-login { width: 100%; padding: 14px; background-color: #007bff; color: white; border: none; border-radius: 6px; cursor: pointer; font-size: 16px; font-weight: bold; transition: background-color 0.2s;}
        .btn-login:hover { background-color: #0056b3; }
        .error { color: #dc3545; font-size: 14px; margin-bottom: 15px; padding: 10px; background-color: #f8d7da; border-radius: 4px;}
    </style>
</head>
<body>
    <div class="login-box">
        <h2>ĐĂNG NHẬP HỆ THỐNG</h2>
        
        <!-- Khu vực hiển thị lỗi nếu có -->
        @if ($errors->any())
            <div class="error">
                {{ $errors->first('email') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login.post') }}">
            @csrf
            <div class="form-group">
                <label for="email">Email đăng nhập:</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="admin@example.com" required autofocus>
            </div>
            
            <div class="form-group">
                <label for="password">Mật khẩu:</label>
                <input type="password" id="password" name="password" placeholder="Nhập mật khẩu..." required>
            </div>
            
            <button type="submit" class="btn-login">Đăng nhập ngay</button>
        </form>
    </div>
</body>
</html>
