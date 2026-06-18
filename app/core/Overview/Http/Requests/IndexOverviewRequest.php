<?php

namespace Core\Overview\Http\Requests;

use App\Supports\Hooks\HookAction;
use App\Supports\Hooks\HookContext;
use App\Supports\Hooks\HookDispatcher;
use App\Supports\Hooks\HookPhase;
use App\Supports\Hooks\HookTiming;
use Illuminate\Foundation\Http\FormRequest;

class IndexOverviewRequest extends FormRequest
{
    public function rules(HookDispatcher $hooks): array
    {
        return [
            ...$hooks->dispatch(
                new HookContext(
                    action: HookAction::INDEX,
                    phase: HookPhase::VALIDATE,
                    timing: HookTiming::ON,
                    payload: [],
                    module: 'Overview'
                )
            )
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}