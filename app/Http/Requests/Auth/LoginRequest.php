<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'password' => 'required',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
