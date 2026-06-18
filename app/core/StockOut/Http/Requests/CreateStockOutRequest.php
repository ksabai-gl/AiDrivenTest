<?php

namespace Core\StockOut\Http\Requests;

use App\Supports\Hooks\HookAction;
use App\Supports\Hooks\HookContext;
use App\Supports\Hooks\HookDispatcher;
use App\Supports\Hooks\HookPhase;
use App\Supports\Hooks\HookTiming;
use Illuminate\Foundation\Http\FormRequest;

class CreateStockOutRequest extends FormRequest
{
    public function rules(HookDispatcher $hooks): array
    {
        return [
            ...$hooks->dispatch(
                new HookContext(
                    action: HookAction::CREATE,
                    phase: HookPhase::VALIDATE,
                    timing: HookTiming::ON,
                    payload: [],
                    module: 'StockOut'
                )
            )
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
