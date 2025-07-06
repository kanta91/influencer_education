<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Curriculum;

class CurriculumSeeder extends Seeder
{
    public function run(): void
    {
        // 学年1〜12（小1〜高3）に各5件の授業を登録
        for ($gradeId = 1; $gradeId <= 12; $gradeId++) {
            for ($i = 1; $i <= 5; $i++) {
                Curriculum::create([
                    'title' => "タイトル{$i}",
                    'thumbnail' => 'https://via.placeholder.com/150',
                    'description' => 'これはテスト用の説明文です。',
                    'video_url' => 'https://example.com/video.mp4',
                    'always_delivery_flg' => 0,
                    'grade_id' => $gradeId,
                ]);
            }
        }
    }
}
