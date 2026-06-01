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
     * Seed the application's database.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'password' => Hash::make('password'),
                'rol' => 'enfermero',
            ]
        );

        User::updateOrCreate(
            ['email' => 'enfermero@example.com'],
            [
                'name' => 'Enfermero Prueba',
                'password' => Hash::make('password'),
                'rol' => 'enfermero',
            ]
        );

        User::updateOrCreate(
            ['email' => 'medico@example.com'],
            [
                'name' => 'Médico Prueba',
                'password' => Hash::make('password'),
                'rol' => 'medico',
            ]
        );

        User::updateOrCreate(
            ['email' => 'director@example.com'],
            [
                'name' => 'Director Hospital',
                'password' => Hash::make('password'),
                'rol' => 'director',
            ]
        );
    }
}
