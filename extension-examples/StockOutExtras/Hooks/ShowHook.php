<?php

namespace Extensions\StockOutExtras\Hooks;

use App\Supports\Hooks\HookContext;
use App\Contracts\Hooks\HookInterface;
use App\Supports\Hooks\HookAction;
use App\Supports\Hooks\HookPhase;
use App\Supports\Hooks\HookResult;
use App\Supports\Hooks\HookTiming;
use Extensions\StockOutExtras\Models\StockinExtrasModel;

class ShowHook implements HookInterface
{
    public static function supports(HookContext $context): bool
    {
        return $context->action === HookAction::SHOW
               && $context->phase === HookPhase::RESPONSE
               && $context->module === 'StockOut'
               && $context->timing === HookTiming::AFTER;
    }

    public function handle(HookContext $context): HookResult
    {
        $row = StockinExtrasModel::where('stockout_id',$context->payload['id'])->first()?->toArray();

        return HookResult::pass([
            ...$context->payload,
            'stock_note' => $row ? $row['note'] : null
        ]);
    }
}
