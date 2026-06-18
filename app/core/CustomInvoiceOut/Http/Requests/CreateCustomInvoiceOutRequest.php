<?php

namespace Core\CustomInvoiceOut\Http\Requests;

use App\Supports\Hooks\HookAction;
use App\Supports\Hooks\HookContext;
use App\Supports\Hooks\HookDispatcher;
use App\Supports\Hooks\HookPhase;
use App\Supports\Hooks\HookTiming;
use Illuminate\Foundation\Http\FormRequest;

class CreateCustomInvoiceOutRequest extends FormRequest
{
    public function rules(HookDispatcher $hooks): array
    {
        $hooks = $hooks->dispatch(
            new HookContext(
                action: HookAction::CREATE,
                phase: HookPhase::VALIDATE,
                timing: HookTiming::ON,
                payload: [],
                module: 'CustomInvoiceOut'
            )
        );
        return [
            ...$hooks,
            'description'    => 'required|string|max:500',
            'amount'         => 'required|numeric|min:0',
            'invoice_date'   => 'required|date',
            'approved'       => 'nullable|boolean',
            'payment_status' => 'sometimes|in:paid,partial_payment,pending',
            'document_no' => 'nullable|max:150',
            'customer_id'    => 'nullable|exists:customers,id'
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
