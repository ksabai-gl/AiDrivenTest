<?php

namespace Core\InvoiceOut\Http\Requests;

use App\Supports\Hooks\HookAction;
use App\Supports\Hooks\HookContext;
use App\Supports\Hooks\HookDispatcher;
use App\Supports\Hooks\HookPhase;
use App\Supports\Hooks\HookTiming;
use Illuminate\Foundation\Http\FormRequest;

class CreateInvoiceOutRequest extends FormRequest
{
    public function rules(HookDispatcher $hooks): array
    {
        return [
            'document_no'  => 'required|string|max:255|unique:invoice_outs,document_no',
            'order_id'     => 'nullable|integer|exists:orders,id',

            'subtotal'     => 'nullable|numeric|min:0',
            'tax'          => 'nullable|numeric|min:0',
            'discount'     => 'nullable|numeric|min:0',
            'total'        => 'nullable|numeric|min:0',

            'payment_status'       => 'required|in:paid,partial_payment,pending',

            'invoice_date' => 'required|date_format:Y-m-d',
            'due_date'     => 'nullable|date_format:Y-m-d',
            'approved'     => 'required|boolean',
            'amount_paid'  => 'nullable|numeric|min:0',
            ...$hooks->dispatch(
                new HookContext(
                    action: HookAction::CREATE,
                    phase: HookPhase::VALIDATE,
                    timing: HookTiming::ON,
                    payload: [],
                    module: 'InvoiceOut'
                )
            ) 
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
