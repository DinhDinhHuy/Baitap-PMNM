<?php

namespace Database\Factories;

use App\Models\LopHoc;
use App\Models\SinhVien;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<SinhVien>
 */
class SinhVienFactory extends Factory
{
    public function definition(): array
    {
        return [
            'lop_hoc_id' => LopHoc::factory(),
            'ho_ten' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'nganh' => fake()->randomElement(['Công nghệ thông tin', 'Kỹ thuật xây dựng', 'Kiến trúc']),
            'phone_number' => fake()->numerify('09########'),
        ];
    }
}
