<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    public function run(): void
    {
        $menus = [
            ['ten' => 'Lớp học', 'url' => '/lophoc', 'vi_tri' => 'sidebar', 'nhom' => 'Quản lý đào tạo', 'thu_tu' => 1],
            ['ten' => 'Sinh viên', 'url' => '/sinhvien', 'vi_tri' => 'sidebar', 'nhom' => 'Quản lý đào tạo', 'thu_tu' => 2],
        ];

        foreach ($menus as $menu) {
            Menu::firstOrCreate(
                ['url' => $menu['url'], 'vi_tri' => $menu['vi_tri']],
                $menu + ['trang_thai' => true],
            );
        }
    }
}
