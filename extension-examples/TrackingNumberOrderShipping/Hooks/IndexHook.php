<?php

namespace Extensions\TrackingNumberOrderShipping\Hooks;

use App\Supports\Hooks\HookContext;
use App\Contracts\Hooks\HookInterface;
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
               && $context->module === 'OrderShipping'
               && $context->timing === HookTiming::ON;
    }

    public function handle(HookContext $context): HookResult
    {
        $context->payload['query'] = $context->payload['query']
            ->addSelect(DB::raw('MAX(TrackingShipping.tracking_number) as tracking_number'))
            ->leftJoin("TrackingShipping","TrackingShipping.shipping_id",
                "=","shippings.id");
        if(!empty($context->payload['data']['tracking_number'])) {
            $context->payload['query'] = $context->payload['query']
            ->where('TrackingShipping.tracking_number',
                'like','%'. $context->payload['data']['tracking_number'] .'%');
        }
        return HookResult::pass($context->payload);
    }
}
