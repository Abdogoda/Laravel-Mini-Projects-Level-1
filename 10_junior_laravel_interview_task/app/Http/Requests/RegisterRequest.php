<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'phone' => 'required|string|unique:users,phone|regex:/^01[0125][0-9]{8}$/', // 011-8numbers // 012 //015 //010
            'password' => ['required', 'string', 'min:6', 'regex:/[a-z]/', 'regex:/[A-Z]/', 'regex:/[0-9]/', 'regex:/[@#$%&*!]/', ]
        ];
    }

    public function messages():array{
        return [
            'password.regex' => 'Your password in week, you must follow the following tips: 1 char small, 1 char capital, 1 number, 1 special char'
        ];
    }
}