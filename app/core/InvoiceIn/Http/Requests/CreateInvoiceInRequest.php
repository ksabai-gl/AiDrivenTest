<?php

namespace Core\InvoiceIn\Http\Requests;

use App\Supports\Hooks\HookAction;
use App\Supports\Hooks\HookContext;
use App\Supports\Hooks\HookDispatcher;
use App\Supports\Hooks\HookPhase;
use App\Supports\Hooks\HookTiming;
use Illuminate\Foundation\Http\FormRequest;

class CreateInvoiceInRequest extends FormRequest
{
    public function rules(HookDispatcher $hooks): array
    {
        return [
            'document_no'   => 'required|string|max:255',
            'purchase_id'   => 'required|integer|exists:purchases,id',
            'subtotal'      => 'required|numeric|min:0',
            'tax'           => 'required|numeric|min:0',
            'discount'      => 'required|numeric|min:0',
            'total'         => 'required|numeric|min:0',
            'invoice_date'  => 'required|date_format:Y-m-d',
            'due_date'      => 'required|date_format:Y-m-d|after_or_equal:invoice_date',
            'approved'      => 'required|boolean',
            'payment_status' => 'required|in:paid,pending,partial_payment',
            'amount_paid'   => 'nullable|numeric|min:0',
            ...$hooks->dispatch(
                new HookContext(
                    action: HookAction::CREATE,
                    phase: HookPhase::VALIDATE,
                    timing: HookTiming::ON,
                    payload: [],
                    module: 'InvoiceIn'
                )
            )
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
