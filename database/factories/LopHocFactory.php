<?php

namespace Database\Factories;

use App\Models\LopHoc;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<LopHoc>
 */
class LopHocFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'ten_lop' => 'Lớp ' . $this->faker->word,
            'ma_lop' => strtoupper($this->faker->unique()->bothify('??-####')),
            'giao_vien' => $this->faker->name,
            'so_dien_thoai' => $this->faker->phoneNumber,
            'ghi_chu' => $this->faker->sentence,
            'si_so' => $this->faker->numberBetween(20, 50),
        ];
    }
}
