<?php

namespace App\Http\Requests\Orders;

use App\Http\Requests\BaseAPIRequest;
use Illuminate\Contracts\Validation\ValidationRule;

class CreateRequest extends BaseAPIRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if(request()->user()->hasPermission('create-order', 'api')) {
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
            'products' => 'required|array',
            'products.*.id' => 'required|uuid|exists:products,id,deleted_at,NULL',
            'products.*.quantity' => 'required|integer|min:1',
        ];
    }

    protected function passedValidation()
    {
    }

    public function messages(): array
    {
        return [
            'products.required' => 'The products field is required',
            'products.array' => 'The products field must be an array',
            'products.*.id.required' => 'The product ID is required',
            'products.*.id.uuid' => 'The product ID must be a valid UUID',
            'products.*.id.exists' => 'The selected product ID is invalid',
            'products.*.quantity.required' => 'The product quantity is required',
            'products.*.quantity.integer' => 'The product quantity must be an integer',
            'products.*.quantity.min' => 'The product quantity must be at least :min',
            'validation_failed' => 'Validation failed',
            'insufficient_stock' => 'Insufficient stock for product: :product',
            'order_created_successfully' => 'Order created successfully',
            'order_creation_failed' => 'Order creation failed',
        ];
    }
}
