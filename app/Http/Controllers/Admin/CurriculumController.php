<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Curriculum;
use App\Models\Grade;
use App\Http\Controllers\Controller;

class CurriculumController extends Controller
{
    public function showCurriculumList($gradeId = null) {
        $CurriculumModel = new Curriculum();
        $GradeModel = new Grade();

        $grades = $GradeModel->getList();

        if (!$gradeId && count($grades) > 0) {
            $gradeId = $grades[0]->id;
        }

        $curriculums = $CurriculumModel->getByGradeId($gradeId);

        $selectedGrade = collect($grades)->firstWhere('id', $gradeId);

        return view('admin.curriculum_list', compact('curriculums','grades','selectedGrade'));
    }



    public function getCurriculumsByGradeAjax($gradeId)
    {
        $CurriculumModel = new Curriculum();
        $curriculums = $CurriculumModel->getByGradeId($gradeId);

        return response()->json($curriculums);
    }

}
