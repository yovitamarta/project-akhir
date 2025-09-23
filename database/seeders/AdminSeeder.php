<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
   // database/seeders/DatabaseSeeder.php

    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@gmail.com'], // cari berdasarkan email
            [
                'name' => 'admin',
                'password' => Hash::make('adminsmk1'),
                'role' => 'admin',
            ]
        );

        User::updateOrCreate(
            ['email' => 'user@gmail.com'],
            [
                'name' => 'user',
                'password' => Hash::make('smk1bisa'),
                'role' => 'user',
            ]
        );
    }

}
