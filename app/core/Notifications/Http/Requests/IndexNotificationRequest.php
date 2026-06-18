<?php

namespace Core\Notifications\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IndexNotificationRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'is_not_read' => 'nullable|numeric|min:0|max:1',
            'get_type'    => 'nullable|numeric|min:0|max:1',
            'type'        => 'nullable|string|max:30'      
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}