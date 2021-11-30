<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePasswordRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'password' => 'required|confirmed',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
