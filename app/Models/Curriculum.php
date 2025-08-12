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
            ->leftJoin('grades', 'curriculums.grade_id', '=', 'grades.id')
            ->where('curriculums.grade_id', $gradeId)
            ->select(
                'curriculums.id',
                'curriculums.title',
                'curriculums.thumbnail',
                'curriculums.always_delivery_flg',
                'grades.grade_name'
            )
            ->get()
            ->map(function ($curriculum) {
                $deliveryTimes = DB::table('delivery_times')
                    ->where('curriculum_id', $curriculum->id)
                    ->select('delivery_from', 'delivery_to')
                    ->get();

                $curriculum->delivery_times = $deliveryTimes;

                return $curriculum;
            });

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
