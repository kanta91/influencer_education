<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserProfileRequest extends FormRequest
{
    public function authorize()
    {
        return true; // ログイン済みユーザー限定ならtrueでOK
    }

    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:50'],
            'name_kana' => ['required', 'regex:/^[ァ-ヶー　]+$/u'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $this->user()->id],
            'profile_image' => ['nullable', 'image', 'max:2048'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '入力必須項目です',
            'name_kana.required' => '入力必須項目です　カタカナで入力してください',
            'name_kana.regex' => 'カタカナで入力してください',
            'email.required' => '入力必須項目です',
            'email.email' => '正しいメールアドレス形式で入力してください',
            'email.unique' => '既に使用されているメールアドレスです',
            'profile_image.image' => '画像ファイルを選択してください。',
            'profile_image.max' => '画像サイズは2MB以下にしてください。',
        ];
    }
}