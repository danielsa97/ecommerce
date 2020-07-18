<?php

namespace App\Http\Requests;

use App\Services\CustomFormRequest;

class CategoryRequest extends CustomFormRequest
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
            'departments' => 'required|array',
            'name' => 'required'
        ];
    }

    public function attributes()
    {
        return [
            'departments' => 'departamento'
        ];
    }
}
