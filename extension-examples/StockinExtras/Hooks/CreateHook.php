<?php

namespace Extensions\StockinExtras\Hooks;
use App\Supports\Hooks\HookContext;
use App\Contracts\Hooks\HookInterface;
use App\Supports\Hooks\HookAction;
use App\Supports\Hooks\HookPhase;
use App\Supports\Hooks\HookResult;
use App\Supports\Hooks\HookTiming;
use Extensions\StockinExtras\Models\StockinExtrasModel;

class CreateHook implements HookInterface
{
    public static function supports(HookContext $context): bool
    {
        return $context->action === HookAction::CREATE
            && $context->phase === HookPhase::RESPONSE
            && $context->module === 'StockIn'
            && $context->timing === HookTiming::AFTER;
    }

    public function handle(HookContext $context): HookResult
    {
        StockinExtrasModel::create([
            'note' => 'No data',
            'stockin_id' => $context->payload['id']
        ]);
        return HookResult::pass([
            ...$context->payload,
            'note' => 'required'
        ]);
    }
}