<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Http\Requests\AdminNoticeRequest;


class NoticeController extends Controller
{
    // お知らせ一覧表示
    public function index()
    {
        $notices = Article::orderBy('posted_date', 'desc')->paginate(10);
        return view('admin.notices.index', compact('notices'));
    }

    // 新規登録フォーム表示
    public function create()
    {
        return view('admin.notices.edit', ['notice' => null]);
    }

    // 登録処理
    public function store(AdminNoticeRequest $request)
    {
        Article::create($request->validated());

        return redirect()->route('admin.notice.index')->with('success', 'お知らせを登録しました。');
    }

    // 編集フォーム表示
    public function edit($id)
    {
        $notice = Article::findOrFail($id);
        return view('admin.notices.edit', compact('notice'));
    }

    // 更新処理
    public function update(AdminNoticeRequest $request, $id)
    {
        $notice = Article::findOrFail($id);
        $notice->update($request->validated());

        return redirect()->route('admin.notice.index')->with('success', 'お知らせを更新しました。');
    }

    // 削除処理
    public function destroy($id)
    {
        $notice = Article::findOrFail($id);
        $notice->delete();

        return redirect()->route('admin.notice.index')->with('success', 'お知らせを削除しました。');
    }
}
