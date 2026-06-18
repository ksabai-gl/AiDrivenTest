<?php

namespace Core\Authencation\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateAuthencationRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'password' => 'required|string|max:64|min:8',
            'email' => 'required|email|string|max:150',
            'name' => 'required|string|max:64',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}