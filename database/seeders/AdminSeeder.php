<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    
    public function run(): void
    {
        // Admin login dengan email
        User::updateOrCreate(
            ['email' => 'admin@mealyung.com'],
            [
                'name' => 'Admin Kantin',
                'password' => Hash::make('adminsmk1'),
                'role' => 'admin',
            ]
        );

        // Guru login dengan NIP
        User::updateOrCreate(
            ['nip' => ''],
            [
                'name' => 'Guru SMK 1',
                'password' => Hash::make('smk1bisa'),
                'role' => 'guru',
            ]
        );

        // Siswa login dengan NIS
        User::updateOrCreate(
            ['nis' => ''],
            [
                'name' => 'Siswa SMK 1',
                'password' => Hash::make('smk1bisa'),
                'role' => 'siswa',
            ]
        );
    }
}
