<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            [
                'email' => 'admin@inomitha.com',
            ],
            [
                'name' => 'Admin InoMitha',
                'password' => Hash::make('InoMitha123'),
            ]
        );
    }
}