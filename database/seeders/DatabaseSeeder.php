<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Akun default:
     *
     * ADMIN  → email: admin@perpustakaan.com  | password: admin123
     * USER   → email: user@perpustakaan.com   | password: user123
     */
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@perpustakaan.com'],
            [
                'name'     => 'Administrator',
                'role'     => 'admin',
                'password' => Hash::make('admin123'),
            ]
        );

        User::firstOrCreate(
            ['email' => 'user@perpustakaan.com'],
            [
                'name'     => 'Pengguna',
                'role'     => 'user',
                'password' => Hash::make('user123'),
            ]
        );
    }
}
