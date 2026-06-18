<?php

namespace Extensions\TrackingNumberOrderShipping\Hooks;
use App\Supports\Hooks\HookContext;
use App\Contracts\Hooks\HookInterface;
use App\Supports\Hooks\HookAction;
use App\Supports\Hooks\HookPhase;
use App\Supports\Hooks\HookResult;
use App\Supports\Hooks\HookTiming;
use Extensions\TrackingNumberOrderShipping\Models\ExampleModel;

class CreateHook implements HookInterface
{
    public static function supports(HookContext $context): bool
    {
        return $context->action === HookAction::CREATE
            && $context->phase === HookPhase::RESPONSE
            && $context->module === 'OrderShipping'
            && $context->timing === HookTiming::AFTER;
    }

    public function handle(HookContext $context): HookResult
    {
        ExampleModel::create([
            'tracking_number' => '',
            'shipping_id' => $context->payload['shipping_id']
        ]);
        return HookResult::pass([
            ...$context->payload,
            'tracking_number' => 'required'
        ]);
    }
}