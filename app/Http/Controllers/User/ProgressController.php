<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Progress;
use App\Models\User;
use App\Helpers\GradeHelper;

class ProgressController extends Controller
{
    public function showProgress()
{
    $user = User::find(1); 

    $order = config('grades.order');

    $grades = \App\Models\Grade::with('classes')->get()->map(function ($grade) {
        $grade->color_class = GradeHelper::gradeColorClass($grade->grade_name);
        return $grade;
    })->sortBy(function ($grade) use ($order) {
        return array_search($grade->grade_name, $order);
    })->values();

    return view('user.progress', compact('user', 'grades'));
}


}
