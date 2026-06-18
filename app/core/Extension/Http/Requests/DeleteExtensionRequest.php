<?php

namespace Core\Extension\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DeleteExtensionRequest extends FormRequest
{
    public function rules(): array
    {
        return [];
    }

    public function authorize(): bool
    {
        return true;
    }
}