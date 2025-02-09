<?php

namespace App\Http\Requests\Panel\Product;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Exists;
use Illuminate\Validation\Rules\Unique;

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
            'product_category_id' => ['required', 'integer', (new Exists('product_categories', 'id'))->where('cafe_id', $this->user()->current_cafe_id)],
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', (new Unique('products', 'slug'))->where('product_category_id', $this->get('product_category_id'))],
            'description' => ['required', 'string'],
            'price' => ['required', 'numeric'],
            'image' => ['required', 'image'],
        ];
    }
}
