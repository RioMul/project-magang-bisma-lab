<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        User::updateOrCreate(
            [
                'email' => 'admin@gmail.com',
            ],
            [
                'name' => 'Admin Bisma Labs',
                'password' => Hash::make('12345678'),
                'is_admin' => true,
            ]
        );

        User::updateOrCreate(
            [
                'email' => 'test@example.com',
            ],
            [
                'name' => 'Test User',
                'password' => Hash::make('password'),
                'is_admin' => false,
            ]
        );

        $this->call([
            PlatformInitSeeder::class,
        ]);
    }
}