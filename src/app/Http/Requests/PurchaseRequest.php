<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth; 

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


    // 配送先のバリデーション
    public function withValidator($validator){
        $validator->after(function ($validator) {
            $user = Auth::user();

            $address = \App\Models\Address::where('user_id', $user->id)
            ->where('item_id', request()->route('item_id'))
            ->latest()
            ->first();

            if (
                (!$user->post_code || !$user->address || !$user->building) &&
                (!$address || !$address->post_code || !$address->address || !$address->building)
            ) {
                $validator->errors()->add('address', '配送先情報を登録してください');
            }
        });
    }

}
