<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BannerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'images.*' => 'nullable|file|mimes:jpg,png|max:30720',
        ];
    }

    public function messages(): array
    {
        return [
            'images.*.mimes' => '登録できる画像形式はjpgまたはpngです。',
            'images.*.max'   => '画像サイズが30MBを超えています。',
        ];      
    }
}
