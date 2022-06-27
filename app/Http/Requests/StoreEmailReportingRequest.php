<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmailReportingRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email_reporting' => 'nullable',
            'email_reporting_to' => 'nullable',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
