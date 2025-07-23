<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CurriculumRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'thumbnail' => 'nullable|image|max:2048', 
            'grade_id' => 'required|exists:grades,id',
            'title' => 'required|string|max:255',
            'video_url' => 'required|url',
            'description' => 'required|string',
            'alway_delivery_flg' => 'nullable|boolean',
        ];
    }

    public function attributes()
    {
        return [
            'thumbnail' => 'サムネイル',
            'grade_id' => '学年',
            'title' => '授業名',
            'video_url' => '動画URL',
            'description' => '授業概要',
            'alway_delivery_flg' => '常時公開',
        ];
    }

    public function messages()
    {
        return [
            'thumbnail.image' => 'サムネイルはファイルを選択してください',
            'thumbnail.max' => 'サムネイルは2MB以内で入力してください',
            'grade_id.required' => '学年を選択してください',
            'title.required' => '授業名を入力してください',
            'title.max' => '授業名は255字以内で入力してください',
            'video_url.required' => '動画URLを入力してください',
            'description.required' => '授業概要を入力してください',
        ];
    }
}
