<?php

namespace Core\ActivityLog\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateActivityLogRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'user_id'     => 'required|integer|exists:users,id',
            'action'      => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'entity_type' => 'required|string|max:255',
            'entity_id'   => 'required|integer',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
