<?php

namespace App\Http\Requests;

use App\Services\CustomFormRequest;

class DiscountRequest extends CustomFormRequest
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
            'name' => 'required|max:255',
            'type' => 'required',
            'value' => 'required',
            'date_start' => 'nullable|date|before_or_equal:date_finish',
            'date_finish' => 'nullable|date|after_or_equal:date_start',
            'quantity_minimum' => 'nullable|numeric',
            'quantity_maximum' => 'nullable|numeric'
        ];
    }
}
