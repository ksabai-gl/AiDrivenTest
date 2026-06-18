<?php

namespace Core\PriceList\Http\Requests;

use App\Supports\Hooks\HookAction;
use App\Supports\Hooks\HookContext;
use App\Supports\Hooks\HookPhase;
use App\Supports\Hooks\HookTiming;
use App\Supports\Hooks\HookDispatcher;
use Illuminate\Foundation\Http\FormRequest;

class DeletePriceListRequest extends FormRequest
{
    public function rules(HookDispatcher $hooks): array
    {
        $hooks = $hooks->dispatch(
            new HookContext(
                action: HookAction::DELETE,
                phase: HookPhase::VALIDATE,
                timing: HookTiming::ON,
                payload: [],
                module: 'PriceList'
            )
        );
        return [
            ...$hooks,
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}