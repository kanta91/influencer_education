<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Curriculum;

class Grade extends Model
{
    use HasFactory;

    protected $fillable = ['grade_name'];

    public function classes()
    {
        return $this->hasMany(Curriculum::class);
    }
}
