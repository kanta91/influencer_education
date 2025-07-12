<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            GradeSeeder::class,         // ← grades テーブルにデータを入れる
            UsersTableSeeder::class,   // ← grade_id を使う前提でユーザーを入れる
        ]);
    }

}
