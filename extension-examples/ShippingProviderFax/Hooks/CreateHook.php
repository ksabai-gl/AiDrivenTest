<?php

namespace Extensions\ShippingProviderFax\Hooks;

use App\Supports\Hooks\HookContext;
use App\Contracts\Hooks\HookInterface;
use App\Supports\Hooks\HookAction;
use App\Supports\Hooks\HookPhase;
use App\Supports\Hooks\HookResult;
use App\Supports\Hooks\HookTiming;
use Extensions\ShippingProviderFax\Models\ShippingProviderFaxModel;

class CreateHook implements HookInterface
{
    public static function supports(HookContext $context): bool
    {
        return $context->action === HookAction::CREATE
            && $context->phase === HookPhase::RESPONSE
            && $context->module === 'Shipping'
            && $context->timing === HookTiming::AFTER;
    }

    public function handle(HookContext $context): HookResult
    {
        $create = ShippingProviderFaxModel::updateOrInsert([
            'shipping_id' => $context->payload['id']
        ],[
            'fax' => $context->payload['fax'],
            'shipping_id' => $context->payload['id'],
            'created_at' => date('Y-m-d H:i:s',time()),
            'updated_at' => date('Y-m-d H:i:s',time()),
        ]);
        return HookResult::pass([
            ...$context->payload,
            'fax' => $create
        ]);
    }
}