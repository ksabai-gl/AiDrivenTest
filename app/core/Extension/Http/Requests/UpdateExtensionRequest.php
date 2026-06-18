<?php

namespace Core\Extension\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateExtensionRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'directory' => 'required|string|max:250',
            'status' => 'required|boolean'
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}