<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UpdateUserProfileRequest;

class ProfileController extends Controller
{
    /**
     * プロフィール編集画面表示
     */
    public function edit()
    {
        // 開発用：ID=1のユーザーで仮ログイン
        if (!Auth::check()) {
            Auth::loginUsingId(1);
        }

        $user = Auth::user();

        return view('user.profile', compact('user'));
    }


    /**
     * プロフィール更新処理
     */
    public function update(UpdateUserProfileRequest $request)
    {
        if (!Auth::check()) {
            Auth::loginUsingId(1);
        }

        $user = Auth::user();

        $validated = $request->validated();


        // 画像アップロード処理
         if ($request->hasFile('profile_image')) {
            // 画像を storage/app/public/profile_images フォルダに保存（例）
            $path = $request->file('profile_image')->store('profile_images', 'public');

            // 既存画像があれば削除する場合はここで処理する（必要に応じて）

            // 保存したパスをDBに登録
            $user->profile_image = $path;
        }

        $user->name = $validated['name'];         // ← user_name ではなく name
        $user->name_kana = $validated['name_kana']; // ← kana ではなく name_kana
        $user->email = $validated['email'];

        $user->save();


        return redirect()->route('user.profile.edit')->with('success', 'プロフィールを更新しました。');
    }

}