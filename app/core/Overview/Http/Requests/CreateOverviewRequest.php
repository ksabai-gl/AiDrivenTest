<?php

namespace Core\Overview\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateOverviewRequest extends FormRequest
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