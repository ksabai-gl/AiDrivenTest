<?php

namespace Core\Authencation\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAuthencationRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'password' => 'nullable|string|max:64',
            'email' => 'required|email|string|max:150',
            'name' => 'required|string|max:64',
            'bio' => 'nullable|string|max:250',
            'avatar' => 'nullable|string|max:250',
            'phone' => 'required|string|max:12',
            'new_password' => 'nullable|string|max:64',
            'lang'=> 'required|in:en,vi,ja',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}