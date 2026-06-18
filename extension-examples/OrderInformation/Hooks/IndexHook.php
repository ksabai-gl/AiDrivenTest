<?php

namespace Extensions\OrderInformation\Hooks;

use App\Supports\Hooks\HookContext;
use App\Contracts\Hooks\HookInterface;
use App\Exceptions\BadException;
use App\Supports\Hooks\HookAction;
use App\Supports\Hooks\HookPhase;
use App\Supports\Hooks\HookResult;
use App\Supports\Hooks\HookTiming;
use Illuminate\Support\Facades\DB;

class IndexHook implements HookInterface
{
    public static function supports(HookContext $context): bool
    {
        return $context->action === HookAction::INDEX
               && $context->phase === HookPhase::QUERY
               && $context->module === 'Order'
               && $context->timing === HookTiming::ON;
    }

    public function handle(HookContext $context): HookResult
    {
        $context->payload['query'] = $context->payload['query']
            ->addSelect(DB::raw('MAX(OrderInformation.hotline) as hotline'))
            ->leftJoin("OrderInformation",
                "OrderInformation.order_id","=","orders.id");
        if(!empty($context->payload['data']['hotline'])) {
            $context->payload['query'] = $context->payload['query']
            ->where('OrderInformation.hotline','like','%'. $context->payload['data']['hotline'] .'%');
        }
        return HookResult::pass($context->payload);
    }
}
