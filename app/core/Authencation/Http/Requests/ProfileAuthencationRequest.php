<?php

namespace Core\Authencation\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileAuthencationRequest extends FormRequest
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