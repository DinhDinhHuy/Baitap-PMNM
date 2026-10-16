<?php

namespace Database\Seeders;

use App\Models\LopHoc;
use Illuminate\Database\Seeder;

class LopHocSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (LopHoc::doesntExist()) {
            LopHoc::factory()->count(20)->create();
        }

        LopHoc::firstOrCreate(['ma_lop' => 'AD-0001'], [
            'ten_lop' => 'Lớp Admin',
            'giao_vien' => 'Admin User',
            'so_dien_thoai' => '0123456789',
            'ghi_chu' => 'Lớp dành cho Admin',
            'si_so' => 1,
        ]);
    }
}
