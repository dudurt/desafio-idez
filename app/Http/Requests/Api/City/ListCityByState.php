<?php

namespace App\Http\Requests\Api\City;

use Illuminate\Foundation\Http\FormRequest;

class ListCityByState extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            "siglaUf" => "required",
        ];
    }

    public function messages()
    {
        return [
            "siglaUf.required" => "O campo 'siglaUf' é obrigatorio, sendo ele a sigla de algum estado!",
        ];
    }
}
