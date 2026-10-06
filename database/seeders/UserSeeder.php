<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Menjalankan database seeder.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@smarttren.test'],
            [
                'name' => 'Admin SmartTren',
                'role' => 'admin',
                'password' => 'password',
            ]
        );

        User::updateOrCreate(
            ['email' => 'pengurus@smarttren.test'],
            [
                'name' => 'Pengurus SmartTren',
                'role' => 'pengurus',
                'password' => 'password',
            ]
        );

        User::updateOrCreate(
            ['email' => 'mahasantri@smarttren.test'],
            [
                'name' => 'Mahasantri SmartTren',
                'role' => 'mahasantri',
                'password' => 'password',
            ]
        );
    }
}