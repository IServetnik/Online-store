<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'description' => 'required|max:65535',
            'price' => 'required|max:12|regex:/^\d+(\.\d{1,3})?$/',
            'category_name' => 'required|max:255',
            'type_name' => 'required|max:255',
            'brand' => 'required|max:255',
            'color' => 'required|max:255',
            'sizes_name.*' => 'required|max:255',
            'quantity.*' => 'required|integer'
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'sizes_name.*' => 'size',
            'quantity.*' => 'size quantity'
        ];
    }
}
