<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Akun Admin
        User::create([
            'nama' => 'Administrator Madrasah',
            'username' => 'admin_madrasah',
            'email' => 'admin@madrasah.id',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        // 2. Akun Guru
        User::create([
            'nama' => 'Ustaz Ahmad',
            'username' => 'guru_ahmad',
            'email' => 'guru@madrasah.id',
            'password' => Hash::make('guru123'),
            'role' => 'guru',
        ]);

        // 3. Akun Wali Santri
        User::create([
            'nama' => 'Bapak Budi',
            'username' => 'wali_budi',
            'email' => 'wali@madrasah.id',
            'password' => Hash::make('wali123'),
            'role' => 'wali_santri',
        ]);
    }
}