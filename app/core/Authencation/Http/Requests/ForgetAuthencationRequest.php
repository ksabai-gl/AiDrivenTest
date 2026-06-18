<?php

namespace Core\Authencation\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ForgetAuthencationRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => 'required|email|string|max:150'
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}