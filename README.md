# Hệ thống quản lý lớp học

Ứng dụng Laravel quản lý lớp học, sinh viên, menu và tài khoản với giao diện Blade dùng chung `layouts.admin`. Danh sách lớp học, sinh viên, menu và tài khoản hỗ trợ phân trang; danh sách có lọc và sắp xếp theo các trường phù hợp.

## Cài đặt và chạy

Yêu cầu PHP 8.3 trở lên và cơ sở dữ liệu được cấu hình trong `.env`.

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve
```

Seed tạo một tài khoản admin và một tài khoản giảng viên mẫu:

| Vai trò | Email | Mật khẩu |
|---|---|---|
| Admin | `admin@example.com` | `password123` |
| Giảng viên | `giangvien@example.com` | `password123` |

Đây là thông tin phục vụ môi trường phát triển; hãy đổi mật khẩu ngay và không dùng các mật khẩu mặc định này ở môi trường production.

## Phân quyền

- **Admin:** quản lý lớp học, sinh viên, menu và tài khoản; có thể tạo, sửa vai trò và xóa tài khoản.
- **Giảng viên:** quản lý lớp học, sinh viên và thông tin tài khoản của chính mình.
- Các route quản trị yêu cầu đăng nhập. Quyền được kiểm soát bằng middleware `auth` và `role`.
- Giao diện quản lý lớp học giữ giới hạn giờ hành chính hiện có (08:30–17:30); API lớp học không áp dụng giới hạn giờ này.

## API

API lớp học và sinh viên dùng bearer token. Đăng nhập để lấy token:

```http
POST /api/login
Content-Type: application/json

{"email":"giangvien@example.com","password":"password123"}
```

Gửi token trong header `Authorization: Bearer <token>`. Token hết hạn sau một năm; gọi `POST /api/logout` để thu hồi token hiện tại.

| Phương thức | Endpoint | Chức năng |
|---|---|---|
| GET, POST | `/api/lophoc` | Liệt kê, tạo lớp học |
| GET, PUT/PATCH, DELETE | `/api/lophoc/{lophoc}` | Xem, cập nhật, xóa lớp học |
| GET, POST | `/api/sinhvien` | Liệt kê, tạo sinh viên |
| GET, PUT/PATCH, DELETE | `/api/sinhvien/{sinhvien}` | Xem, cập nhật, xóa sinh viên |

Các danh sách API hỗ trợ phân trang và tham số lọc/sắp xếp như `q`, `sort`, `direction`, `per_page`; lớp học hỗ trợ thêm `trang_thai`, sinh viên hỗ trợ `lop_hoc_id`.

## Kiểm thử

```bash
php artisan test
```
