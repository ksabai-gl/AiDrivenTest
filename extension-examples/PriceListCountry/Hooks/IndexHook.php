<?php

namespace Extensions\PriceListCountry\Hooks;

use App\Supports\Hooks\HookContext;
use App\Contracts\Hooks\HookInterface;
use App\Supports\Hooks\HookAction;
use App\Supports\Hooks\HookPhase;
use App\Supports\Hooks\HookResult;
use App\Supports\Hooks\HookTiming;

class IndexHook implements HookInterface
{
    public static function supports(HookContext $context): bool
    {
        return $context->action === HookAction::INDEX
            && $context->phase === HookPhase::QUERY
            && $context->module === 'PriceList'
            && $context->timing === HookTiming::ON;
    }

    public function handle(HookContext $context): HookResult
    {
        $context->payload['query'] = $context->payload['query']
        ->leftJoin("PriceListCountry","PriceListCountry.price_list_id",
            "=","price_list.id")
        ->addSelect("PriceListCountry.country");
        if(!empty($context->payload['data']['country'])) {
            $context->payload['query'] = $context->payload['query']
                ->where('PriceListCountry.country',
                    'like','%'. $context->payload['data']['country'] .'%');
        }
        return HookResult::pass([
            ...$context->payload 
        ]);
    }
}