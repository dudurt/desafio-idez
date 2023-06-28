<?php

namespace App\Http\Requests\Api\City;

use Illuminate\Foundation\Http\FormRequest;

class ListCity extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            "data" => "required",
        ];
    }

    public function messages()
    {
        return [
            "data.required" => "O campo 'data' é obrigatorio!",
        ];
    }
}
