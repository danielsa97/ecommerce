<?php

namespace App\Http\Requests;

use App\Services\CustomFormRequest;

class BrandRequest extends CustomFormRequest
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
            'name' => 'required'
        ];
        if ($this->isMethod('POST')) {
            $rules['image'] = ['required', 'file'];
        }
        return $rules;
    }

    public function attributes()
    {
        return [
            'image' => 'imagem'
        ];
    }
}
