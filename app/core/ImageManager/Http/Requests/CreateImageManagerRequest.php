<?php

namespace Core\ImageManager\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateImageManagerRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'file' => 'required|image|mimes:jpg,jpeg,png,webp|max:5120'
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
