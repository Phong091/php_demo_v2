<?php

namespace App\Containers\Sample\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SampleRequest extends FormRequest
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
            // "email" => ['required', 'email', 'max:100', 'unique:m_customers,active_login_id'],
        ];
    }

    public function messages()
    {
        return [
            // 'email' => __('validation.some-message'),
        ];
    }
}
