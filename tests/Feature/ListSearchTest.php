<?php

namespace Tests\Feature;

use App\Models\LopHoc;
use App\Models\SinhVien;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ListSearchTest extends TestCase
{
    use RefreshDatabase;

    public function test_class_list_can_be_searched_by_class_name_code_or_teacher(): void
    {
        LopHoc::create([
            'ten_lop' => 'Công nghệ phần mềm',
            'ma_lop' => 'CNTT01',
            'giao_vien' => 'Nguyễn Văn An',
            'so_dien_thoai' => '0900000001',
            'si_so' => 30,
        ]);
        LopHoc::create([
            'ten_lop' => 'Thiết kế đồ họa',
            'ma_lop' => 'TKDH01',
            'giao_vien' => 'Trần Thị Bình',
            'so_dien_thoai' => '0900000002',
            'si_so' => 25,
        ]);

        $this->get(route('lophoc.index', ['q' => 'An']))
            ->assertOk()
            ->assertSee('Công nghệ phần mềm')
            ->assertDontSee('Thiết kế đồ họa')
            ->assertSee('Tìm thấy')
            ->assertSee('value="An"', false);
    }

    public function test_class_list_can_filter_by_class_size_and_select_rows_per_page(): void
    {
        foreach (range(1, 12) as $size) {
            LopHoc::create([
                'ten_lop' => "Lớp {$size}",
                'ma_lop' => "LOP{$size}",
                'giao_vien' => 'Giáo viên',
                'so_dien_thoai' => '0900000000',
                'si_so' => $size + 10,
            ]);
        }

        $this->get(route('lophoc.index', [
            'si_so_tu' => 11,
            'si_so_den' => 22,
            'per_page' => 10,
        ]))
            ->assertOk()
            ->assertSee('Tìm thấy <strong>12</strong> lớp học', false)
            ->assertSee('name="si_so_tu"', false)
            ->assertSee('value="11"', false)
            ->assertSee('name="si_so_den"', false)
            ->assertSee('value="22"', false)
            ->assertSee('<option value="10" selected>', false)
            ->assertSee('si_so_tu=11', false)
            ->assertSee('per_page=10', false);
    }

    public function test_class_list_can_be_filtered_by_status(): void
    {
        LopHoc::create([
            'ten_lop' => 'Lớp đang hoạt động',
            'ma_lop' => 'ACTIVE01',
            'giao_vien' => 'Giáo viên A',
            'so_dien_thoai' => '0900000001',
            'si_so' => 20,
            'trang_thai' => 'Hoạt động',
        ]);
        LopHoc::create([
            'ten_lop' => 'Lớp đã ngừng',
            'ma_lop' => 'STOPPED01',
            'giao_vien' => 'Giáo viên B',
            'so_dien_thoai' => '0900000002',
            'si_so' => 15,
            'trang_thai' => 'Ngừng',
        ]);

        $this->get(route('lophoc.index', ['trang_thai' => 'Ngừng']))
            ->assertOk()
            ->assertSee('Lớp đã ngừng')
            ->assertDontSee('Lớp đang hoạt động')
            ->assertSee('<option value="Ngừng" selected>', false);
    }

    public function test_class_size_range_must_be_in_ascending_order(): void
    {
        $this->get(route('lophoc.index', [
            'si_so_tu' => 20,
            'si_so_den' => 10,
        ]))
            ->assertRedirect()
            ->assertSessionHasErrors('si_so_tu');
    }

    public function test_class_status_can_be_created_and_updated(): void
    {
        $classData = [
            'ten_lop' => 'Lớp kiểm thử',
            'ma_lop' => 'TEST01',
            'giao_vien' => 'Giáo viên kiểm thử',
            'so_dien_thoai' => '0900000000',
            'si_so' => 20,
            'trang_thai' => 'Hoạt động',
        ];

        $this->post(route('lophoc.store'), $classData)
            ->assertRedirect(route('lophoc.index'));

        $class = LopHoc::where('ma_lop', 'TEST01')->firstOrFail();
        $this->assertSame('Hoạt động', $class->trang_thai);

        $this->put(route('lophoc.update', $class), array_merge($classData, [
            'trang_thai' => 'Ngừng',
        ]))
            ->assertRedirect(route('lophoc.index'));

        $this->assertDatabaseHas('lop_hocs', [
            'id' => $class->id,
            'trang_thai' => 'Ngừng',
        ]);
    }

    public function test_student_list_can_be_searched_by_student_details(): void
    {
        $this->actingAs(User::factory()->create());

        SinhVien::create([
            'ho_ten' => 'Nguyễn Minh Anh',
            'email' => 'minhanh@example.com',
            'nganh' => 'Công nghệ thông tin',
            'phone_number' => '0912345678',
        ]);
        SinhVien::create([
            'ho_ten' => 'Trần Gia Bảo',
            'email' => 'giabao@example.com',
            'nganh' => 'Thiết kế đồ họa',
            'phone_number' => '0987654321',
        ]);

        $this->get(route('sinhvien.index', ['q' => 'Thiết kế']))
            ->assertOk()
            ->assertSee('Trần Gia Bảo')
            ->assertDontSee('Nguyễn Minh Anh')
            ->assertSee('Tìm thấy')
            ->assertSee('value="Thiết kế"', false);
    }
}
