<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UpdateUserPasswordRequest;


class PasswordController extends Controller
{
    /**
     * パスワード変更画面表示
     */
    public function edit()
    {
        return view('user.password');
    }

    /**
     * パスワード更新処理
     */
    public function update(UpdateUserPasswordRequest $request)
    {
        $user = Auth::user();

        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->route('user.password.edit')->with('success', 'パスワードを更新しました。');
    }
}
