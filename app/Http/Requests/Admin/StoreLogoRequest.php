<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreLogoRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'logo' => 'image|required',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
