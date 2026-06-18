<?php

namespace Core\Authencation\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResetAuthencationRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'token' => 'required|string'
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}