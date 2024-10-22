<?php

namespace App\Http\Requests;

use App\Traits\ApiResponseTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class BaseAPIRequest extends FormRequest
{
    use ApiResponseTrait;

    public function rules(): array
    {
        return [
            'secret_api_key' => 'required|string',
        ];
    }

    public function messages(): array
    {
        return [
            'secret_api_key.required' => __('auth.secret_api_key_required'),
            'secret_api_key.string' => __('auth.secret_api_key_string'),
        ];
    }

    protected function getValidatorInstance(): Validator
    {
        $validator = parent::getValidatorInstance();
        $validator->addRules($this->rules());

        return $validator;
    }

    /**
     * Handle unauthorized response.
     *
     * @return void
     */
    protected function handleUnauthorizedResponse(): void
    {
        throw new HttpResponseException(
            $this->UnAuthorizedResponse('This action is unauthorized')
        );
    }
}
