<?php

namespace Extensions\ProductRenew\Hooks;
use App\Supports\Hooks\HookContext;
use App\Contracts\Hooks\HookInterface;
use App\Supports\Hooks\HookAction;
use App\Supports\Hooks\HookPhase;
use App\Supports\Hooks\HookResult;
use App\Supports\Hooks\HookTiming;
use Extensions\ProductRenew\Models\ExampleModel;

class CreateHook implements HookInterface
{
    public static function supports(HookContext $context): bool
    {
        return $context->action === HookAction::CREATE
            && $context->phase === HookPhase::RESPONSE
            && $context->module === 'Product'
            && $context->timing === HookTiming::AFTER;
    }

    public function handle(HookContext $context): HookResult
    {
        ExampleModel::create([
            'is_renew' => $context->payload['is_renew'] === 'New' ? false : true,
            'product_id' => $context->payload['id']
        ]);
        return HookResult::pass([
            ...$context->payload
        ]);
    }
}