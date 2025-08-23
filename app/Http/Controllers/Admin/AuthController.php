<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required', 'string', 'email', 'min:8', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'max:255'],
        ], [
            'email.required' => 'メールアドレスまたはパスワードが正しくありません',
            'email.email' => '有効なメールアドレスの形式で入力してください',
            'password.required' => 'メールアドレスまたはパスワードが正しくありません',
            'password.min' => 'パスワードは８文字以上で入力してください',
        ]);

        if (Auth::guard('admin')->attempt($credentials)) {
        
            $request->session()->regenerate();
            return redirect()->route('admin.show.top');
        }

        return back()->withErrors([
            'email' => 'メールアドレスまたはパスワードが正しくありません。',
        ])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.show.login');
    }

    public function showRegisterForm()
    {
        return view('admin.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name'     => ['required','max:255','regex:/^[^\x01-\x7E]+$/u'],
            'kana'     => ['required','max:255','regex:/^[ァ-ヶー　]+$/u'],
            'email'    => ['required','string','email:rfc,dns','max:255','unique:admins','regex:/^[A-Za-z0-9._-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/i'],
            'password' => ['required','string','min:8','max:255','confirmed'],
        ], [
            'name.required'      => 'ユーザーネームが入力されていません。ユーザーネームは全角で入力してください。',
            'name.regex'         => 'ユーザーネームは全角文字で入力してください。',
            'kana.required'      => 'カナが入力されていません。カナは全角カタカナで入力してください。',
            'kana.regex'         => 'カナは全角カタカナで入力してください。',
            'email.required'     => 'メールアドレスが入力されていません。',
            'email.email'        => 'メールアドレスの形式が正しくありません。',
            'email.regex'        => 'メールアドレスに使用できない文字が含まれています。',
            'email.unique'       => 'このメールアドレスは既に登録されています。',
            'password.required'  => 'パスワードが入力されていません。パスワードは8文字以上入力してください。',
            'password.confirmed' => '確認用パスワードを入力してください。',
        ]);

        $admin = Admin::create([
            'name'     => $validated['name'],
            'kana'     => $validated['kana'],
            'email'    => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        Auth::guard('admin')->login($admin);

        return redirect()->route('admin.show.top')->with('success', '登録が完了しました！');
    }
}
