<?php

namespace Database\Factories;

use App\Models\Menu;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Menu>
 */
class MenuFactory extends Factory
{
    public function definition(): array
    {
        return [
            'ten' => fake()->words(2, true),
            'url' => '/'.fake()->slug(),
            'vi_tri' => fake()->randomElement(array_keys(Menu::VI_TRI)),
            'nhom' => null,
            'thu_tu' => fake()->numberBetween(0, 20),
            'trang_thai' => true,
        ];
    }
}
