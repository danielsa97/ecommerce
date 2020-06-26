<?php

namespace App\Http\Requests;


use App\Services\CustomFormRequest;

class UserRequest extends CustomFormRequest
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
        $rules = [
            'name' => "required",
            'email' => "required|email|unique:users,email,{$this->id}",
            'password' => ["confirmed", "nullable", "min:8"]
        ];

        if ($this->isMethod('POST')) {
            array_push($rules['password'], "required");
        }
        return $rules;
    }
}
