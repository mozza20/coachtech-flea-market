<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
    public function rules(){
        return [
            'prof_img'=>['file','mimes:jpeg,png'],
            'name'=>['required','string'],
            'post_code'=>['required','string','regex:/^\d{3}-\d{4}$/'],
            'address'=>['required','string'],
            'building'=>['required','string'],
        ];
    }

    public function messages(){
        return[
            'prof_img.mimes'=>'プロフィール画像は拡張子が.jpegもしくは.pngのファイルをアップロードしてください',
            'name.required'=>'お名前を入力してください',
            'post_code.required'=>'郵便番号を入力してください',
            'post_code.regex'=>'郵便番号はハイフンを含む8文字で入力してください',
            'address.required'=>'住所を入力してください',
            'building.required'=>'建物名を入力してください',
        ];
    }

}
