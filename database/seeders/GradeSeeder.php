<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('grades')->insert([
            ['id' => 1, 'grade_name' => '小学校1年生'],
            ['id' => 2, 'grade_name' => '小学校2年生'],
            ['id' => 3, 'grade_name' => '小学校3年生'],
            ['id' => 4, 'grade_name' => '小学校4年生'],
            ['id' => 5, 'grade_name' => '小学校5年生'],
            ['id' => 6, 'grade_name' => '小学校6年生'],
            ['id' => 7, 'grade_name' => '中学校1年生'],
            ['id' => 8, 'grade_name' => '中学校2年生'],
            ['id' => 9, 'grade_name' => '中学校3年生'],
            ['id' => 10, 'grade_name' => '高校1年生'],
            ['id' => 11, 'grade_name' => '高校2年生'],
            ['id' => 12, 'grade_name' => '高校3年生'],
        ]);
    }
}
