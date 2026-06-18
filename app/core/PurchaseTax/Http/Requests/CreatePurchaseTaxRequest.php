<?php

namespace Core\PurchaseTax\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePurchaseTaxRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'tax' => 'required|numeric|max:100|min:0',
            'id' => 'required|numeric|exists:purchases,id,status,draft,deleted_at,NULL',
            'purchase_items_id.*' => 'required|numeric|exists:purchase_items,id',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}