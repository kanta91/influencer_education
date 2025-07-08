<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CurriculumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        {
            DB::table('curriculums')->insert([
                [
                    'title' => 'プログラミング基礎',
                    'thumbnail' => 'sample.jpg',
                    'always_delivery_flg' => 1,
                    'grade_id' => 1
                ],
                [
                    'title' => 'プログラミング基礎2',
                    'thumbnail' => 'sample.jpg',
                    'always_delivery_flg' => 0,
                    'grade_id' => 2
                ],
                [
                    'title' => 'プログラミング基礎3',
                    'thumbnail' => 'sample.jpg',
                    'always_delivery_flg' => 1,
                    'grade_id' => 3
                ],
                [
                    'title' => 'プログラミング基礎4',
                    'thumbnail' => 'sample.jpg',
                    'always_delivery_flg' => 1,
                    'grade_id' => 4
                ],
                [
                    'title' => 'プログラミング基礎5',
                    'thumbnail' => 'sample.jpg',
                    'always_delivery_flg' => 0,
                    'grade_id' => 5
                ],
                [
                    'title' => 'プログラミング基礎6',
                    'thumbnail' => 'sample.jpg',
                    'always_delivery_flg' => 1,
                    'grade_id' => 6
                ],
            ]);
        }
    }
}
