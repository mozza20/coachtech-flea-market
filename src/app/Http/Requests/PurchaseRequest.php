<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PurchaseRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'payment'=>['required','in:コンビニ払い,カード払い'],
        ];
    }

    public function messages(){
        return[
            'payment.required'=>'支払方法を選択してください',
        ];
    }
}
