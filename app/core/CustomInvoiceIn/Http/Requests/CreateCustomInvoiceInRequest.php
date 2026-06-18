<?php

namespace Core\CustomInvoiceIn\Http\Requests;

use App\Supports\Hooks\HookAction;
use App\Supports\Hooks\HookContext;
use App\Supports\Hooks\HookDispatcher;
use App\Supports\Hooks\HookPhase;
use App\Supports\Hooks\HookTiming;
use Illuminate\Foundation\Http\FormRequest;

class CreateCustomInvoiceInRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(HookDispatcher $hooks): array
    {
        $hooks = $hooks->dispatch(
            new HookContext(
                action: HookAction::CREATE,
                phase: HookPhase::VALIDATE,
                timing: HookTiming::ON,
                payload: [],
                module: 'CustomInvoiceIn'
            )
        );
        return [
            ...$hooks,
            'supplier_id' => 'required|integer|exists:suppliers,id',

            'document_no' => 'nullable|string|max:100',

            'description' => 'required|string|max:500',

            'amount' => 'required|numeric|min:0',

            'invoice_date' => 'required|date',

            'payment_status' => 'required|in:paid,partial_payment,pending',
            'approved'  => 'required|boolean'
        ];
    }
}
