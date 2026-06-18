<?php

namespace Core\Shipping\Http\Requests;

use App\Supports\Hooks\HookAction;
use App\Supports\Hooks\HookContext;
use App\Supports\Hooks\HookDispatcher;
use App\Supports\Hooks\HookPhase;
use App\Supports\Hooks\HookTiming;
use Illuminate\Foundation\Http\FormRequest;

class CreateShippingRequest extends FormRequest
{
     public function rules(HookDispatcher $dispatch): array
    {
        return [
            'name'   => 'required|string|max:150',
            'code'   => 'required|string|max:100',
            'logo'   => 'nullable|string|max:255',
            'active' => 'nullable|boolean',
            ...$dispatch->dispatch(
                new HookContext(
                    action: HookAction::CREATE,
                    phase: HookPhase::VALIDATE,
                    timing: HookTiming::ON,
                    payload: [],
                    module: 'Shipping'
                )
            )
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}