<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\Category;

class ProductCreateRequest extends FormRequest
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
            'name' => 'required|unique:products|max:255',
            'price' => 'required|regex:/^\d+(\.\d{1,3})?$/',
            'category_name' => 'required|max:255',
            'type' => 'required',
            'brand' => 'required|max:255',
            'color' => 'required|max:255',
        ];
    }
}
