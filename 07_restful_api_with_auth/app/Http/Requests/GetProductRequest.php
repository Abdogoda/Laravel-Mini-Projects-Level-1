<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GetProductRequest extends FormRequest
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
            'search' => 'sometimes|string|max:50',
            'category_id' => 'sometimes|exists:categories,id',
            'min_price' => 'sometimes|numeric|min:0|max:10000',
            'max_price' => 'sometimes|numeric|min:0|max:10000',
            'sort_by' => 'sometimes|in:id,name,price,created_at',
            'sort_order' => 'sometimes|in:asc,desc',
            'per_page' => 'sometimes|numeric|min:3|max:100',
        ];
    }
}