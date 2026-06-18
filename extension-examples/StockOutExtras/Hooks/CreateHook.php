<?php

namespace Extensions\StockOutExtras\Hooks;
use App\Supports\Hooks\HookContext;
use App\Contracts\Hooks\HookInterface;
use App\Supports\Hooks\HookAction;
use App\Supports\Hooks\HookPhase;
use App\Supports\Hooks\HookResult;
use App\Supports\Hooks\HookTiming;
use Extensions\StockOutExtras\Models\StockinExtrasModel;

class CreateHook implements HookInterface
{
    public static function supports(HookContext $context): bool
    {
        return $context->action === HookAction::CREATE
            && $context->phase === HookPhase::RESPONSE
            && $context->module === 'StockOut'
            && $context->timing === HookTiming::AFTER;
    }

    public function handle(HookContext $context): HookResult
    {
        StockinExtrasModel::create([
            'note' => 'No data',
            'stockout_id' => $context->payload['id']
        ]);
        return HookResult::pass([
            ...$context->payload,
            'note' => 'required'
        ]);
    }
}