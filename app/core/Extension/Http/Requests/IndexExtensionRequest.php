<?php

namespace Core\Extension\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IndexExtensionRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'keywords' => 'nullable|string|max:255'
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}