<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin',
                'password' => 'password123',
                'role' => 'admin',
            ]
        );
        if ($admin->role !== 'admin') {
            $admin->update(['role' => 'admin']);
        }
        User::firstOrCreate(
            ['email' => 'giangvien@example.com'],
            [
                'name' => 'Giảng viên mẫu',
                'password' => 'password123',
                'role' => 'lecturer',
            ]
        );
        $this->call([
            LopHocSeeder::class,
            SinhVienSeeder::class,
            MenuSeeder::class,
        ]);

    }
}
