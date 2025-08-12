<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DeliveryRequest extends FormRequest
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
    public function rules(): array
    {
        $rules = [];
    
        foreach ($this->input('delivery', []) as $index => $item) {
            $rules["delivery.$index.from_date"] = ['required', 'regex:/^\d{8}$/'];
            $rules["delivery.$index.from_time"] = ['required', 'regex:/^\d{4}$/'];
            $rules["delivery.$index.to_date"]   = ['required', 'regex:/^\d{8}$/'];
            $rules["delivery.$index.to_time"]   = ['required', 'regex:/^\d{4}$/'];
        }
    
        return $rules;
    }
    
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            foreach ($this->input('delivery', []) as $index => $item) {
                // 必須エラーがある場合は比較しない
                if (
                    empty($item['from_date']) || empty($item['from_time']) ||
                    empty($item['to_date'])   || empty($item['to_time'])
                ) {
                    continue;
                }
    
                $from = $item['from_date'] . $item['from_time'];
                $to   = $item['to_date'] . $item['to_time'];
    
                if ($from >= $to) {
                    $validator->errors()->add("delivery.$index.to_date", "終了日時は開始日時より後にしてください。");
                }
            }
        });
    }

    public function messages(): array
    {
        return [
            'delivery.*.from_date.required' => '開始日を入力してください',
            'delivery.*.from_date.regex'    => '開始日は半角8桁の数字で入力してください',

            'delivery.*.from_time.required' => '開始時間を入力してください',
            'delivery.*.from_time.regex'    => '開始時間は半角4桁の数字で入力してください',

            'delivery.*.to_date.required'   => '終了日を入力してください',
            'delivery.*.to_date.regex'      => '終了日は半角8桁の数字で入力してください',

            'delivery.*.to_time.required'   => '終了時間を入力してください',
            'delivery.*.to_time.regex'      => '終了時間は半角4桁の数字で入力してください',
        ];
    }
}
