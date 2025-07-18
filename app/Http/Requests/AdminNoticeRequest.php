<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminNoticeRequest extends FormRequest
{
    public function authorize()
    {
        return true; // 認可OK（ログインチェックはmiddlewareで）
    }

    public function rules()
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'posted_date' => ['required', 'date'],
            'article_contents' => ['required', 'string'],
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'タイトルを入力してください',
            'posted_date.required' => '投稿日時を入力してください',
            'article_contents.required' => '本文を入力してください',
        ];
    }
}
