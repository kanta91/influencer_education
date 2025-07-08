<?php

namespace App\Helpers;

use Illuminate\Support\Str;

class GradeHelper
{
    public static function gradeColorClass($gradeName)
    {
        if (Str::startsWith($gradeName, '小学校')) return 'elementary';
        if (Str::startsWith($gradeName, '中学校')) return 'middle';
        if (Str::startsWith($gradeName, '高校')) return 'high';
        return '';
    }
}
