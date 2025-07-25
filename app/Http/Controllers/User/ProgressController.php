<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Grade;
use App\Helpers\GradeHelper;

class ProgressController extends Controller
{
    /**

     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function showProgress(Request $request)
    {
        // 仮でユーザーを取得（ログイン処理スキップのため）
         $user = User::with('grade')->first(); // 例えばDBの最初のユーザーを取得

        
        if (!$user) {
            abort(404, 'ユーザーが存在しません');
        }

        // 全学年を取得して順序でソート
        $grades = Grade::with(['classes' => function ($query) use ($user) {
            $query->with(['userProgress' => function ($subQuery) use ($user) {
                $subQuery->where('user_id', $user->id);
            }]);
        }])->get();

        // 学年を正しい順序でソート
        $grades = $grades->sortBy(function ($grade) {
            return GradeHelper::getGradeOrder($grade->grade_name);
        });

        // 各授業の受講状況を設定
        foreach ($grades as $grade) {
            foreach ($grade->classes as $class) {
                $class->is_completed = $class->userProgress->isNotEmpty();
            }
        }

        return view('user.progress', compact('user', 'grades'));
    }

}