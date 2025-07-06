<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Progress;
use App\Models\User;

class ProgressController extends Controller
{
    public function showProgress()
    {
        $user = \App\Models\User::find(1); 
        $grades = \App\Models\Grade::with('classes')->get()->sortBy(function($grade) {
            
            $order = [
                '小学校1年生', '小学校2年生', '小学校3年生',
                '小学校4年生', '小学校5年生', '小学校6年生',
                '中学校1年生', '中学校2年生', '中学校3年生',
                '高校1年生', '高校2年生', '高校3年生'
            ];
            return array_search($grade->grade_name, $order);
        })->values(); 

        



        return view('user.progress', compact('user', 'grades'));
    
     }

}
