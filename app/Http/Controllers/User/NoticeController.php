<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Http\Requests\StoreArticleRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\UpdateArticleRequest;

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

    public function store(StoreArticleRequest $request)
    {
        $validated = $request->validated();

        DB::transaction(function () use ($validated) {
            Article::create($validated);
        });

        return redirect()->route('admin.notice.index')->with('success', 'お知らせを登録しました');
    }

    public function update(UpdateArticleRequest $request, $id)
    {
        $notice = Article::findOrFail($id);
        $validated = $request->validated();

        DB::transaction(function () use ($notice, $validated) {
            $notice->update($validated);
        });

        return redirect()->route('admin.notice.index')->with('success', 'お知らせを更新しました');
    }

    

    public function destroy($id)
    {
        $notice = Article::findOrFail($id);

        DB::transaction(function () use ($notice) {
            $notice->delete();
        });

        return redirect()->route('admin.notice.index')->with('success', 'お知らせを削除しました');
    }

}
