<?php

namespace Core\PriceList\Http\Requests;

use App\Supports\Hooks\HookAction;
use App\Supports\Hooks\HookContext;
use App\Supports\Hooks\HookPhase;
use App\Supports\Hooks\HookTiming;
use App\Supports\Hooks\HookDispatcher;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePriceListRequest extends FormRequest
{
    public function rules(HookDispatcher $hooks): array
    {
        $hooks = $hooks->dispatch(
            new HookContext(
                action: HookAction::UPDATE,
                phase: HookPhase::VALIDATE,
                timing: HookTiming::ON,
                payload: [],
                module: 'PriceList'
            )
        );
        return [
            ...$hooks,
            'customer_group_id' => 'required|integer|exists:customer_group,id',
            'product_id'        => 'required|integer|exists:products,id',
            'price'             => 'required|numeric|min:0',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
