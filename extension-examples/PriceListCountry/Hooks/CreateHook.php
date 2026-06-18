<?php

namespace Extensions\PriceListCountry\Hooks;

use App\Supports\Hooks\HookContext;
use App\Contracts\Hooks\HookInterface;
use App\Supports\Hooks\HookAction;
use App\Supports\Hooks\HookPhase;
use App\Supports\Hooks\HookResult;
use App\Supports\Hooks\HookTiming;
use Extensions\PriceListCountry\Models\PriceListCountryModel;

class CreateHook implements HookInterface
{
    public static function supports(HookContext $context): bool
    {
        return $context->action === HookAction::CREATE
            && $context->phase === HookPhase::RESPONSE
            && $context->module === 'PriceList'
            && $context->timing === HookTiming::AFTER;
    }

    public function handle(HookContext $context): HookResult
    {
        $create = PriceListCountryModel::updateOrInsert([
            'price_list_id' => $context->payload['id']
        ],[
            'country' => $context->payload['country'],
            'price_list_id' => $context->payload['id'],
            'created_at' => date('Y-m-d H:i:s',time()),
            'updated_at' => date('Y-m-d H:i:s',time()),
        ]);
        return HookResult::pass([
            ...$context->payload,
            'country' => $create
        ]);
    }
}