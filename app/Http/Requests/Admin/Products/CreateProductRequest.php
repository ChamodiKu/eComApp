<?php

namespace App\Http\Requests\Admin\Products;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'product_name' => 'required|min:1|max:255',
            'brand' => 'nullable|min:0|max:255',
            'description' => 'nullable',
            'quantity' => 'required|numeric',
            'cost_price' => 'required|numeric', // Ensure it's numeric
            'sell_price' => 'required|numeric', // Ensure it's numeric
            'is_active' => 'boolean', // Ensure it's boolean
            'rating' => 'numeric', // Ensure it's numeric
        ];
    }

    public function messages()
    {
        return [
            'product_name.required' => 'Name is required',
            'product_name.min' => 'Name is too short',
            'product_name.max' => 'Name is too long',

            'brand.max' => 'Brand name too long',

            'description.max' => 'Description too long',

            'quantity.required' => 'Quantity is required',
            'quantity.numeric' => 'Is new must be a number',

            'cost_price.required' => 'Cost price is required',
            'cost_price.numeric' => 'Cost price must be a number',

            'sell_price.required' => 'Sell price is required',
            'sell_price.numeric' => 'Sell price must be a number',

            'is_active.boolean' => 'Status must be a boolean value',

            'rating.numeric' => 'Weight must be a number'
        ];
    }
}
