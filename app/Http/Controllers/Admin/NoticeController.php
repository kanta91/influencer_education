<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller; // ← これが正解！
use App\Models\Article;
use Illuminate\Http\Request;

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
        return view('admin.notices.create');
    }

    // 新規登録処理
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'posted_date' => 'required|date',
            'article_contents' => 'required|string',
        ]);

        Article::create($validated);

        return redirect()->route('admin.notices.index')->with('success', 'お知らせを登録しました。');
    }

    // 編集フォーム表示
    public function edit($id)
    {
        $notice = Article::findOrFail($id);
        return view('admin.notices.edit', compact('notice'));
    }

    // 更新処理
    public function update(Request $request, $id)
    {
        $notice = Article::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'posted_date' => 'required|date',
            'article_contents' => 'required|string',
        ]);

        $notice->update($validated);

        return redirect()->route('admin.notices.index')->with('success', 'お知らせを更新しました。');
    }

    // 削除処理
    public function destroy($id)
    {
        $notice = Article::findOrFail($id);
        $notice->delete();

        return redirect()->route('admin.notices.index')->with('success', 'お知らせを削除しました。');
    }
}
