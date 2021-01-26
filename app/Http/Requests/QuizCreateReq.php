<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuizCreateReq extends FormRequest
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
            'baslik'=>'required|min:5',
            'kategori'=>'required',
            'gorsel' => 'image|nullable|max:1024|mimes:jpg,jpeg,png',
        ];
    }

    public function attributes()
    {
        return [
            'baslik'=>'Quiz başlığı',
            'gorsel' => 'Quiz resmi'
        ];
    }
}
