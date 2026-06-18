<?php

namespace Extensions\CustomerFax\Hooks;
use App\Supports\Hooks\HookContext;
use App\Contracts\Hooks\HookInterface;
use App\Exceptions\BadException;
use App\Supports\Hooks\HookAction;
use App\Supports\Hooks\HookPhase;
use App\Supports\Hooks\HookResult;
use App\Supports\Hooks\HookTiming;
use Extensions\CustomerFax\Models\ExampleModel;

class UpdateHook implements HookInterface
{
    public static function supports(HookContext $context): bool
    {
        return $context->action === HookAction::UPDATE
            && $context->phase === HookPhase::RESPONSE
            && $context->module === 'Customer'
            && $context->timing === HookTiming::BEFORE;
    }

    public function handle(HookContext $context): HookResult
    {

        ExampleModel::updateOrInsert([
            'customer_id' => $context->payload['id'],
        ],[
            'fax' => $context->payload['fax'],
            'customer_id' => $context->payload['id'],
            'created_at' => date('Y-m-d H:i:s',time()),
            'updated_at' => date('Y-m-d H:i:s',time())
        ]);
        return HookResult::pass([
            ...$context->payload,
            'fax' => 'required'
        ]);
    }
}