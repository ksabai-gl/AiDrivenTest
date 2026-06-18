<?php

namespace Core\StockIn\Http\Requests;

use App\Supports\Hooks\HookAction;
use App\Supports\Hooks\HookContext;
use App\Supports\Hooks\HookDispatcher;
use App\Supports\Hooks\HookPhase;
use App\Supports\Hooks\HookTiming;
use Illuminate\Foundation\Http\FormRequest;

class ShowStockInRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(HookDispatcher $dispatch): array
    {
        return [
            ...$dispatch->dispatch(
                new HookContext(
                    action: HookAction::SHOW,
                    phase: HookPhase::VALIDATE,
                    timing: HookTiming::ON,
                    payload: [],
                    module: 'StockIn'
                )
            )
        ];
    }
}
