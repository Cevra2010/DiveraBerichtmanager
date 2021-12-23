<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUebungRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'thema' => 'required',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
