<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContractPreviewRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'template_id' => ['required', 'integer', 'exists:templates,id'],
            'data' => ['required', 'array'],
        ];
    }
}
