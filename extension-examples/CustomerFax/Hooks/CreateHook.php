<?php

namespace Extensions\CustomerFax\Hooks;
use App\Supports\Hooks\HookContext;
use App\Contracts\Hooks\HookInterface;
use App\Supports\Hooks\HookAction;
use App\Supports\Hooks\HookPhase;
use App\Supports\Hooks\HookResult;
use App\Supports\Hooks\HookTiming;
use Extensions\CustomerFax\Models\ExampleModel;

class CreateHook implements HookInterface
{
    public static function supports(HookContext $context): bool
    {
        return $context->action === HookAction::CREATE
            && $context->phase === HookPhase::RESPONSE
            && $context->module === 'Customer'
            && $context->timing === HookTiming::AFTER;
    }

    public function handle(HookContext $context): HookResult
    {
        ExampleModel::create([
            'fax' => $context->payload['fax'],
            'customer_id' => $context->payload['customer_id']
        ]);
        return HookResult::pass([
            ...$context->payload,
            'fax' => 'required'
        ]);
    }
}