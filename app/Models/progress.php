<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Progress extends Model
{
    protected $table = 'curriculum_progresses';

    protected $fillable = [
        'user_id',
        'curriculum_id',
        // 進捗に関する他のカラムがあればここに追加
    ];

    // 進捗が紐づくユーザー
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // 進捗が紐づく授業（カリキュラム）
    public function curriculum()
    {
        return $this->belongsTo(Curriculum::class);
    }
}
