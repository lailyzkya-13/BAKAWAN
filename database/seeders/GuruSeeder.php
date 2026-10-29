<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class GuruSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'guru@bakawan.test'],
            [
                'name' => 'Guru BAKAWAN',
                'password' => Hash::make('GuruBakawan@2026'),
            ]
        );
    }
}
