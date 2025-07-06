<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'テスト太郎',
            'name_kana' => 'テストタロウ',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
            'grade_id' => 1,
            'profile_image' => null,
        ]);
    }
}
