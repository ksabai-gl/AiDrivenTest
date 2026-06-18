<?php

namespace Core\Order\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Supports\Hooks\HookAction;
use App\Supports\Hooks\HookContext;
use App\Supports\Hooks\HookPhase;
use App\Supports\Hooks\HookTiming;
use App\Supports\Hooks\HookDispatcher;

class CreateOrderRequest extends FormRequest
{
    public function rules(HookDispatcher $hooks): array
    {
        // Dispatch hooks to retrieve additional validation rules
        $hookRules = $hooks->dispatch(
            new HookContext(
                action: HookAction::CREATE,
                phase: HookPhase::VALIDATE,
                timing: HookTiming::ON,
                payload: [],
                module: 'Order'
            )
        );

        return [
            ...$hookRules, // Merge any hook-based rules
            'customer_id'   => 'required|integer|exists:customers,id',
            'order_date' => 'required|date',
            'order_no' => 'nullable|string|max:150',
            'expected_delivery_date' => 'required|date|after_or_equal:order_date',
            'note'        => 'nullable|string',
            'type'        => 'required|in:retail,wholesale',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}

