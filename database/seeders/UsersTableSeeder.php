<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        // 小学生
        User::create([
            'name' => '山田太郎(小学生)',
            'name_kana' => 'ヤマダタロウ',
            'email' => 'tarou1@gmail.com',
            'password' => Hash::make('password123'),
            'grade_id' => 1,
            'profile_image' => 'profile_images/boy_face_smile.png',
        ]);

        // 中学生
        User::create([
            'name' => '山田太郎(中学生)',
            'name_kana' => 'ヤマダタロウ',
            'email' => 'tarou2@gmail.com',
            'password' => Hash::make('password123'),
            'grade_id' => 7,
            'profile_image' => 'profile_images/boy_face_smile.png',
        ]);

        // 高校生
        User::create([
            'name' => '山田太郎(高校生)',
            'name_kana' => 'ヤマダタロウ',
            'email' => 'tarou3@gmail.com',
            'password' => Hash::make('password123'),
            'grade_id' => 10,
            'profile_image' => 'profile_images/boy_face_smile.png',
        ]);
    }
}
