<?php

namespace Core\Authencation\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginAuthencationRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'password' => 'required|string|max:64',
            'email' => 'required|email|string|max:150'
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}