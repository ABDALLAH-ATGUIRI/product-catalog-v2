<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchRequest extends FormRequest
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
            'product_name' => 'nullable|string|max:255',
            'price_min' => 'nullable|numeric',
            'price_max' => 'nullable|numeric',
            'category' => 'nullable|numeric|exists:categories,id',
            'current_page' => 'nullable|numeric',
        ];
    }
}
