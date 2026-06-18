<?php

namespace Core\OrderShipping\Http\Requests;

use App\Supports\Hooks\HookAction;
use App\Supports\Hooks\HookContext;
use App\Supports\Hooks\HookDispatcher;
use App\Supports\Hooks\HookPhase;
use App\Supports\Hooks\HookTiming;
use Illuminate\Foundation\Http\FormRequest;

class ShowOrderShippingRequest extends FormRequest
{
    public function rules(HookDispatcher $hooks): array
    {
        $hookRules = $hooks->dispatch(
            new HookContext(
                action: HookAction::SHOW,
                phase: HookPhase::VALIDATE,
                timing: HookTiming::ON,
                payload: [],
                module: 'OrderShipping'
            )
        );

        return [
            ...$hookRules,
            'order_id' => 'required|exists:orders,id'
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
