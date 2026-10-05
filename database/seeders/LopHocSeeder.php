<?php

namespace Database\Seeders;

use App\Models\LopHoc;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LopHocSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        LopHoc::factory()->count(20)->create();
        LopHoc::factory()->create([
            'ten_lop' => 'Lớp Admin',
            'ma_lop' => 'AD-0001',
            'giao_vien' => 'Admin User',
            'so_dien_thoai' => '0123456789',
            'ghi_chu' => 'Lớp dành cho Admin',
            'si_so' => 1,
        ]);

        
    }
}
