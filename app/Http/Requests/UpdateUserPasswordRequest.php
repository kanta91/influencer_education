<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UpdateUserPasswordRequest extends FormRequest
{
    public function authorize()
    {
        return true; // ログインユーザー限定ならtrue
    }

    public function rules()
    {
        return [
            'current_password' => ['required', 'string', 'min:8', 'regex:/^[\x20-\x7E]+$/'],
            'new_password' => ['required', 'string', 'min:8', 'confirmed', 'regex:/^[\x20-\x7E]+$/'],
        ];
    }

    public function messages()
    {
        return [
            'current_password.required' => '現在のパスワードを入力してください。',
            'current_password.min' => '8文字以上で入力してください。',
            'current_password.regex' => '半角英数字記号のみ使用可能です。',
            'new_password.required' => '新しいパスワードを入力してください。',
            'new_password.min' => '8文字以上で入力してください。',
            'new_password.confirmed' => '新しいパスワードが確認用と一致しません。',
            'new_password.regex' => '半角英数字記号のみ使用可能です。',
        ];
    }

   
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if (!Hash::check($this->current_password, Auth::user()->password)) {
                $validator->errors()->add('current_password', '現在のパスワードと一致していません。');
            }
        });
    }
}