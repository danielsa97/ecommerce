<?php


namespace App\Services;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CustomFormRequest extends FormRequest
{
    protected function failedValidation(Validator $validator)
    {
        $errors = [];
        foreach ($validator->errors()->toArray() as $key => $value) {
            $keyName = explode('.', $key);
            if (!isset($errors[$keyName[0]])) {
                $errors[$keyName[0]] = $value[0];
            }
        }
        $response = [
            "success" => false,
            "message" => "Dados inválidos.",
            "errors" => $errors,
        ];

        throw new HttpResponseException(response()->json($response, 422));
    }
}
