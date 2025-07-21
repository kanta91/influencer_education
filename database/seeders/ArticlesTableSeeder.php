<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Article;
use Carbon\Carbon;

class ArticlesTableSeeder extends Seeder
{
    public function run()
    {
        // 1件目
        Article::create([
            'title' => 'おしらせテストタイトル',
            'posted_date' => Carbon::create(2025, 7, 20),
            'article_contents' => "お知らせテスト",
        ]);

        // 2件目
        Article::create([
            'title' => 'おしらせテストタイトル',
            'posted_date' => Carbon::create(2025, 7, 20),
            'article_contents' => str_repeat("お知らせテスト", 13), // 13回繰り返し
        ]);

        // 3件目：削除用お知らせ
        Article::create([
            'title' => '削除用お知らせ',
            'posted_date' => Carbon::create(2025, 7, 20),
            'article_contents' => '削除用お知らせテスト',
        ]);

        // 4件目：タイトル変更用
        Article::create([
            'title' => 'タイトル変更用',
            'posted_date' => Carbon::create(2025, 7, 20),
            'article_contents' => 'タイトル変更用',
        ]);

        // 5件目：投稿日変更用
        Article::create([
            'title' => '投稿日変更用',
            'posted_date' => Carbon::create(2025, 7, 20),
            'article_contents' => '投稿日変更用',
        ]);

        // 6件目：本文変更用
        Article::create([
            'title' => '本文変更用',
            'posted_date' => Carbon::create(2025, 7, 20),
            'article_contents' => '本文変更用',
        ]);
    }
}
