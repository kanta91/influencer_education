<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'name_kana',     
        'email',
        'password',
        'grade_id',       
        'profile_image',  
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    
    public function updateProfile(array $validated, Request $request)
    {
        if ($request->hasFile('profile_image')) {
            if ($this->profile_image && Storage::disk('public')->exists($this->profile_image)) {
                Storage::disk('public')->delete($this->profile_image);
            }

            $path = $request->file('profile_image')->store('profile_images', 'public');
            $this->profile_image = $path;
        }

        $this->name = $validated['name'];
        $this->name_kana = $validated['name_kana'];
        $this->email = $validated['email'];

        $this->save();
    }

    
    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }

    
    public function getProfileImageAttribute($value)
    {
        return $value ?? 'https://via.placeholder.com/100';
    }
}
