<?php

namespace Database\Seeders;

use App\Models\LopHoc;
use App\Models\SinhVien;
use Illuminate\Database\Seeder;

class SinhVienSeeder extends Seeder
{
    public function run(): void
    {
        if (SinhVien::exists()) {
            return;
        }

        $classIds = LopHoc::query()->pluck('id');
        if ($classIds->isEmpty()) {
            return;
        }

        SinhVien::factory()->count(30)->sequence(fn () => ['lop_hoc_id' => $classIds->random()])->create();
    }
}
