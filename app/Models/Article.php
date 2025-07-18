<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = 'articles';

    protected $dates = [
        'posted_date',
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'title',
        'posted_date',
        'article_contents',
    ];
}
