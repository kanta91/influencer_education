<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Curriculum extends Model
{
    protected $table = 'curriculums';
    
    public function getByGradeId($gradeId)
    {
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

    public function showCurriculumStore($request,$thumbnail)
    {
        DB::table('curriculums')->insert([
            'thumbnail' => $thumbnail ?? 'sample.jpg',
            'grade_id' => $request->input('grade_id'),
            'title' => $request->input('title'),
            'video_url' => $request->input('video_url'),
            'description' => $request->input('description'),
            'always_delivery_flg' => $request->input('alway_delivery_flg',0),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function showCurriculumUpdate($request,$thumbnail,$id)
    {
        DB::table('curriculums')->where('id' ,$id)->update([
            'thumbnail' => $thumbnail,
            'grade_id' => $request->input('grade_id'),
            'title' => $request->input('title'),
            'video_url' => $request->input('video_url'),
            'description' => $request->input('description'),
            'always_delivery_flg' => $request->input('alway_delivery_flg',0),
            'updated_at' => now(),
        ]);
    }
}
