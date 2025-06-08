<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExhibitionRequest extends FormRequest
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
            'name'=>['required'],
            'description'=>['required','string','max:255'],
            'img_url'=>['required','file','mimes:jpeg,jpg,png'],
            'category_ids'=>['required','array','min:1'],
            'category_ids.*' => ['exists:categories,id'],
            'condition_id'=>['required'],
            'price'=>['required'],        
        ];
    }

    public function messages(){
        return[
            'name.required'=>'商品名を入力してください',
            'description.required'=>'商品説明を入力してください',
            'description.max'=>'商品説明は255文字以内で入力してください',
            'img_url.required'=>'画像ファイルを選択してください',
            'img_url.mimes'=>'画像ファイルはjpgもしくはpngを選択してください',
            'category_ids.required'=>'カテゴリを選択してください',
            'condition_id.required'=>'商品の状態を選択してください',
            'price.required'=>'販売価格を入力してください',
        ];
    }
}
