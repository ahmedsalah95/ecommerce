<?php

namespace App\Http\Requests;

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
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0.01',
            'category_id' => 'required|integer|exists:categories,id',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Product name is required.',
            'name.unique' => 'Product name already exists.',
            'price.required' => 'Product price is required.',
            'price.numeric' => 'Product price must be a number.',
            'price.min' => 'Product price must be at least :min.',
            'category_id.required' => 'Product category is required.',
            'category_id.integer' => 'Product category must be a number.',
            'category_id.exists' => 'Selected product category is invalid.',
            'image.image' => 'The :attribute must be an image.',
            'image.mimes' => 'The :attribute must be a file of type: :values.',
            'image.max' => 'The :attribute may not be greater than :max kilobytes.',
            'stock.integer' => 'The :attribute must be an integer.',
            'stock.min' => 'The :attribute must be at least :min.',

        ];
    }
}
