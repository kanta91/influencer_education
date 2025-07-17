// database/seeders/CurriculumsTableSeeder.php
<?php

use Illuminate\Database\Seeder;
use App\Models\Grade;
use App\Models\Curriculum;

class CurriculumsTableSeeder extends Seeder
{
    public function run()
    {
        $grades = Grade::all();

        foreach ($grades as $grade) {
            for ($i = 1; $i <= 5; $i++) {
                Curriculum::create([
                    'grade_id' => $grade->id,
                    'title' => "{$grade->grade_name}の授業{$i}",
                    // 必要に応じて他のカラム（例えば description など）を追加
                ]);
            }
        }
    }
}
