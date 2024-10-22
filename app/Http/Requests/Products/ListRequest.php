<?php

namespace App\Http\Requests\Products;

use App\Http\Requests\BaseAPIRequest;
use Illuminate\Contracts\Validation\ValidationRule;

class ListRequest extends BaseAPIRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if(request()->user()->hasPermission('show-products', 'api')) {
            return true;
        }

        $this->handleUnauthorizedResponse();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'per_page' => 'nullable|integer|min:1|max:100',
            'cursor' => 'nullable|string|max:255',
            'name' => 'nullable|string|max:255',
            'min_price' => 'nullable|regex:/^\d{1,8}(\.\d{1,2})?$/',
            'max_price' => 'nullable|regex:/^\d{1,8}(\.\d{1,2})?$/',
            'category_id' => 'nullable|uuid|exists:categories,id,deleted_at,NULL',
        ];
    }

    public function messages(): array
    {
        return [
            'per_page.integer' => __('products.per_page_integer'),
            'per_page.min' => __('products.per_page_min', ['min' => 1]),
            'per_page.max' => __('products.per_page_max', ['max' => 100]),
            'cursor.string' => __('products.cursor_string'),
            'cursor.max' => __('products.cursor_max', ['max' => 255]),
            'name.string' => __('products.name_string'),
            'name.max' => __('products.name_max', ['max' => 255]),
            'min_price.regex' => __('products.min_price_regex'),
            'max_price.regex' => __('products.max_price_regex'),
            'category_id.uuid' => __('products.category_id_uuid'),
            'category_id.exists' => __('products.category_id_exists'),
        ];
    }
}
