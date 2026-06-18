<?php

namespace Core\Extension\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateExtensionRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'file' => 'required|mimes:zip|max:10240'
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}