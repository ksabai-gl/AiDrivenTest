<?php

namespace Core\StockIn\Http\Requests;

use App\Supports\Hooks\HookAction;
use App\Supports\Hooks\HookContext;
use App\Supports\Hooks\HookDispatcher;
use App\Supports\Hooks\HookPhase;
use App\Supports\Hooks\HookTiming;
use Illuminate\Foundation\Http\FormRequest;

class UpdateStockInRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(HookDispatcher $dispatch): array
    {
        return [
            'import_date' => 'required|date_format:Y-m-d',
            'status'      => 'required|in:pending,received',
            ...$dispatch->dispatch(
                new HookContext(
                    action: HookAction::UPDATE,
                    phase: HookPhase::VALIDATE,
                    timing: HookTiming::ON,
                    payload: [],
                    module: 'StockIn'
                )
            )
        ];
    }
}
