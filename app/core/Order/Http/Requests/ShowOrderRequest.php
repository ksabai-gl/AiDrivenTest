<?php

namespace Core\Order\Http\Requests;

use App\Supports\Hooks\HookAction;
use App\Supports\Hooks\HookContext;
use App\Supports\Hooks\HookDispatcher;
use App\Supports\Hooks\HookPhase;
use App\Supports\Hooks\HookTiming;
use Illuminate\Foundation\Http\FormRequest;

class ShowOrderRequest extends FormRequest
{
    public function rules(HookDispatcher $hooks): array
    {
        $additionalRules = $hooks->dispatch(
            new HookContext(
                action: HookAction::SHOW,
                phase: HookPhase::VALIDATE,
                timing: HookTiming::ON,
                payload: [],
                module: 'Order'
            )
        );

        return [
            ...$additionalRules, 

        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
