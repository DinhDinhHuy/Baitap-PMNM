<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Trang đích tuyệt đẹp với phong cách thiết kế hiện đại.">
    <title>Khám Phá Sự Khác Biệt</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #6366f1;
            --primary-hover: #818cf8;
            --bg-color: #0f172a;
            --text-main: #f8fafc;
            --text-muted: #cbd5e1;
            --glass-bg: rgba(255, 255, 255, 0.05);
            --glass-border: rgba(255, 255, 255, 0.1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Outfit', sans-serif;
        }

        body {
            background-color: var(--bg-color);
            background-image: 
                radial-gradient(circle at 15% 50%, rgba(99, 102, 241, 0.15), transparent 25%),
                radial-gradient(circle at 85% 30%, rgba(168, 85, 247, 0.15), transparent 25%);
            color: var(--text-main);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            overflow-x: hidden;
        }

        /* Nav */
        nav {
            padding: 1.5rem 5%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            backdrop-filter: blur(10px);
            border-bottom: 1px solid var(--glass-border);
            animation: slideDown 0.8s ease-out forwards;
        }

        .logo {
            font-size: 1.8rem;
            font-weight: 800;
            background: linear-gradient(135deg, #818cf8, #c084fc);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            letter-spacing: -1px;
        }

        .nav-links a {
            color: var(--text-muted);
            text-decoration: none;
            margin-left: 2rem;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .nav-links a:hover {
            color: var(--text-main);
        }

        /* Hero */
        .hero {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 4rem 1rem;
            position: relative;
        }

        .hero::before {
            content: '';
            position: absolute;
            width: 300px;
            height: 300px;
            background: var(--primary);
            filter: blur(150px);
            opacity: 0.3;
            z-index: -1;
            animation: pulse 6s infinite alternate;
        }

        .badge {
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            padding: 0.5rem 1rem;
            border-radius: 2rem;
            font-size: 0.9rem;
            margin-bottom: 2rem;
            color: #a78bfa;
            backdrop-filter: blur(4px);
            animation: fadeInUp 0.8s ease-out 0.2s forwards;
            opacity: 0;
            transform: translateY(20px);
        }

        h1 {
            font-size: clamp(3rem, 6vw, 5rem);
            font-weight: 800;
            line-height: 1.1;
            margin-bottom: 1.5rem;
            max-width: 800px;
            background: linear-gradient(to right, #ffffff, #a5b4fc);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: fadeInUp 0.8s ease-out 0.4s forwards;
            opacity: 0;
            transform: translateY(20px);
        }

        .hero p {
            font-size: 1.2rem;
            color: var(--text-muted);
            max-width: 600px;
            margin-bottom: 3rem;
            line-height: 1.6;
            animation: fadeInUp 0.8s ease-out 0.6s forwards;
            opacity: 0;
            transform: translateY(20px);
        }

        .btn-group {
            display: flex;
            gap: 1.5rem;
            animation: fadeInUp 0.8s ease-out 0.8s forwards;
            opacity: 0;
            transform: translateY(20px);
        }

        .btn {
            padding: 1rem 2rem;
            border-radius: 3rem;
            font-weight: 600;
            font-size: 1.1rem;
            text-decoration: none;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .btn-primary {
            background: var(--primary);
            color: white;
            box-shadow: 0 0 20px rgba(99, 102, 241, 0.4);
            border: 2px solid var(--primary);
        }

        .btn-primary:hover {
            background: var(--primary-hover);
            box-shadow: 0 0 30px rgba(99, 102, 241, 0.6);
            transform: translateY(-2px);
        }

        .btn-secondary {
            background: var(--glass-bg);
            color: white;
            border: 1px solid var(--glass-border);
            backdrop-filter: blur(10px);
        }

        .btn-secondary:hover {
            background: rgba(255, 255, 255, 0.1);
            transform: translateY(-2px);
        }

        /* Features */
        .features {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
            padding: 4rem 5%;
            max-width: 1200px;
            margin: 0 auto;
        }

        .card {
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            border-radius: 1.5rem;
            padding: 2.5rem;
            backdrop-filter: blur(10px);
            transition: transform 0.3s ease, background 0.3s ease;
            opacity: 0;
            animation: fadeUpIn 0.8s ease-out 1s forwards;
        }

        .card:hover {
            transform: translateY(-10px);
            background: rgba(255, 255, 255, 0.08);
            border-color: rgba(255, 255, 255, 0.2);
        }

        .card-icon {
            font-size: 2.5rem;
            margin-bottom: 1.5rem;
            background: linear-gradient(135deg, #818cf8, #c084fc);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .card h3 {
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }

        .card p {
            color: var(--text-muted);
            line-height: 1.5;
        }

        /* Animations */
        @keyframes slideDown {
            from { transform: translateY(-100%); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        @keyframes fadeInUp {
            to { transform: translateY(0); opacity: 1; }
        }
        
        @keyframes fadeUpIn {
            from { transform: translateY(40px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        @keyframes pulse {
            0% { transform: scale(1); opacity: 0.3; }
            100% { transform: scale(1.2); opacity: 0.5; }
        }

        @media (max-width: 768px) {
            .nav-links { display: none; }
            .btn-group { flex-direction: column; width: 100%; max-width: 300px; }
            .btn { width: 100%; text-align: center; }
        }
    </style>
</head>
<body>

    <nav>
        <div class="logo">NeoWeb.</div>
        <div class="nav-links">
            <a href="#">Trang chủ</a>
            <a href="#">Tính năng</a>
            <a href="#">Bảng giá</a>
            <a href="#">Liên hệ</a>
        </div>
    </nav>

    <main class="hero">
        <div class="badge">🚀 Mượt mà & Hiện đại</div>
        <h1>Định Hình Lại Trải Nghiệm Web</h1>
        <p>Mang đến giao diện tuyệt đẹp, hiệu suất vượt trội và thiết kế ấn tượng. Bắt đầu ngay hôm nay để đưa sản phẩm của bạn lên một tầm cao mới.</p>
        <div class="btn-group">
            <a href="#" class="btn btn-primary">Khám Phá Ngay</a>
            <a href="#" class="btn btn-secondary">Xem Hướng Dẫn</a>
        </div>
    </main>

    <section class="features">
        <div class="card">
            <div class="card-icon">⚡</div>
            <h3>Siêu Tốc Độ</h3>
            <p>Trải nghiệm tốc độ tải trang cực nhanh, mang lại cảm giác mượt mà không tưởng cho người dùng.</p>
        </div>
        <div class="card">
            <div class="card-icon">🎨</div>
            <h3>Giao Diện Đẹp Mắt</h3>
            <p>Thiết kế tinh tế theo xu hướng Glassmorphism hiện đại, kết hợp với các hiệu ứng chuyển động bắt mắt.</p>
        </div>
        <div class="card">
            <div class="card-icon">🛡️</div>
            <h3>Bảo Mật Tối Đa</h3>
            <p>Hệ thống được xây dựng với tiêu chuẩn cao nhất để đảm bảo an toàn tuyệt đối cho người dùng.</p>
        </div>
    </section>

</body>
</html>