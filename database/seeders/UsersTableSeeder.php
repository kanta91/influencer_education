<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => '山田太郎',
            'name_kana' => 'ヤマダタロウ',
            'email' => 'test@example.com',
            'password' => Hash::make('password123'),
            'grade_id' => 1, 
            'profile_image' => null, 
        ]);
    }
}
