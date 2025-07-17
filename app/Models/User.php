<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
    'name',
    'name_kana',     
    'email',
    'password',
    'grade_id',       
    'profile_image',  
];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function updateProfile(array $validated, Request $request)
{
    // 画像アップロード処理
    if ($request->hasFile('profile_image')) {
        // 古い画像を削除（任意）
        if ($this->profile_image && Storage::disk('public')->exists($this->profile_image)) {
            Storage::disk('public')->delete($this->profile_image);
        }

        // 新しい画像を保存
        $path = $request->file('profile_image')->store('profile_images', 'public');
        $this->profile_image = $path;
    }

    // その他のプロフィール情報を更新
    $this->name = $validated['name'];
    $this->name_kana = $validated['name_kana'];
    $this->email = $validated['email'];

    $this->save();
}
}
