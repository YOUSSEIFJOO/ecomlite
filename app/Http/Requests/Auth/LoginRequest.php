<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\BaseAPIRequest;
use Illuminate\Contracts\Validation\ValidationRule;

class LoginRequest extends BaseAPIRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email',
            'password' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => __('auth.email_required'),
            'email.email' => __('auth.email_email'),
            'password.required' => __('auth.password_required'),
        ];
    }
}
