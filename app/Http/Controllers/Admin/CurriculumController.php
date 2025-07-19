<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Curriculum;
use App\Models\Grade;
use App\Http\Controllers\Controller;
use App\Http\Requests\CurriculumRequest;
use Illuminate\Support\Facades\DB;

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



    public function getCurriculumsByGradeAjax($gradeId){
        $CurriculumModel = new Curriculum();
        $curriculums = $CurriculumModel->getByGradeId($gradeId);

        return response()->json($curriculums);
    }


    public function showCurriculumCreate() {
        $GradeModel = new Grade();
        $grades = $GradeModel->getList();

        return view('admin.curriculum_create', compact('grades'));
    }

    public function showCurriculumStore(CurriculumRequest $request){

        $img = $request->file('thumbnail');
        $thumbnail = null;
    
        if ($img !== null) {
            $file_name = $img->getClientOriginalName();
            $img->storeAs('public/images', $file_name);
            $thumbnail = 'images/' . $file_name;
        }

        DB::beginTransaction();

        try {
            $model = new Curriculum();
            $model->showCurriculumStore($request,$thumbnail);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            dd($e->getMessage());
            return back();
        }

        return redirect()->route('admin.show.curriculum.list')->with('success', '授業を登録しました');
    }

    public function showCurriculumEdit($id) {
        $GradeModel = new Grade();
        $CurriculumModel = new Curriculum();
        $grades = $GradeModel->getList();
        $curriculum = $CurriculumModel->where('id', $id)->first();

        return view('admin.curriculum_edit', compact('grades' , 'curriculum'));
    }


    public function showCurriculumUpdate(CurriculumRequest $request,$id,){

        $CurriculumModel = new Curriculum();
        $curriculum = $CurriculumModel->where('id', $id)->first();

        $img = $request->file('thumbnail');
        $thumbnail = $curriculum->thumbnail;
    
        if ($img !== null) {
            $file_name = $img->getClientOriginalName();
            $img->storeAs('public/images', $file_name);
            $thumbnail = 'images/' . $file_name;
        }

        DB::beginTransaction();

        try {
            $model = new Curriculum();
            $model->showCurriculumUpdate($request,$thumbnail,$id);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            dd($e->getMessage());
            return back();
        }

        return redirect()->route('admin.show.curriculum.list')->with('success', '授業を更新しました');
    }

}
