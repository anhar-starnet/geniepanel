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
                'email' => 'anhar010401@gmail.com',
            ],
            [
                'name' => 'Administrator',
                'password' => Hash::make('admin12345'),
            ]
        );
    }
}