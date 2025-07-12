<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Article;

class NoticeController extends Controller
{
    // ミドルウェアは外す（認証なしにするため）
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function show($id)
    {
        $notice = Article::findOrFail($id);
        return view('user.notice_detail', compact('notice'));
    }
}
