<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    // テーブル名明示（規約通りなら不要）
    protected $table = 'articles';

    // 日付カラムのキャスト
    protected $dates = [
        'posted_date',
        'created_at',
        'updated_at',
    ];

    // ホワイトリスト
    protected $fillable = [
        'title',
        'posted_date',
        'article_contents',
    ];
}
