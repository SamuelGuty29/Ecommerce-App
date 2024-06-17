<?php

namespace App\Http\Requests\product;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{

    protected $rules = [
        'name' => ['required', 'string'],
        'price' => ['required', 'numeric'],
        'description' => ['nullable', 'string'],
        'stock' => ['required', 'numeric'],
        'category_id' => ['required', 'numeric']
    ];
    
    public function authorize()
    {
        return true;
    }

    
    public function rules()
    {

        return $this->rules;
    }

    public function messages()
    {
        return [
            'name.required' => 'El nombre del producto es requerido',
            'name.string' => 'El nombre del producto debe ser un texto',
            'price.required' => 'El precio del producto es requerido',
            'price.numeric' => 'El precio del producto debe ser un número',
           'stock.required' => 'El stock es requerido',
           'stock.numeric' => 'El stock debe ser un número',
            'category_id.required' => 'La categoría es requerida',
            'category_id.numeric' => 'La categoría debe ser un número'
        ];
        
    }
}
