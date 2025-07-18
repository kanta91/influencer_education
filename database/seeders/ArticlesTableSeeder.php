<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Article;
use Carbon\Carbon;

class ArticlesTableSeeder extends Seeder
{
    public function run()
    {
        Article::create([
            'title' => 'お知らせタイトル',
            'posted_date' => Carbon::now(),
            'article_contents' => "これはシーダーで登録したお知らせの本文です。\n改行も反映されます。",
        ]);
    }
}
