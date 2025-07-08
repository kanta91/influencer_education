<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Curriculum extends Model
{
    public function getByGradeId($gradeId){
        $curriculums = DB::table('curriculums')
            ->leftjoin('grades', 'curriculums.grade_id', '=', 'grades.id')
            ->leftjoin('delivery_times', 'curriculums.id', '=', 'delivery_times.curriculum_id')
            ->where('curriculums.grade_id', $gradeId)
            ->select(
                'curriculums.id',
                'curriculums.title',
                'curriculums.thumbnail',
                'curriculums.always_delivery_flg',
                'grades.grade_name',
                'delivery_times.delivery_time',
                'delivery_times.delivery_to'
            )
            ->get();
        
        return $curriculums;
    }
}
