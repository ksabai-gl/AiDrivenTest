<?php

namespace Extensions\ProductRenew\Hooks;

use App\Supports\Hooks\HookContext;
use App\Contracts\Hooks\HookInterface;
use App\Exceptions\BadException;
use App\Supports\Hooks\HookAction;
use App\Supports\Hooks\HookPhase;
use App\Supports\Hooks\HookResult;
use App\Supports\Hooks\HookTiming;
use Extensions\ProductRenew\Models\ExampleModel;
use Illuminate\Support\Facades\DB;

class IndexHook implements HookInterface
{
    public static function supports(HookContext $context): bool
    {
        return $context->action === HookAction::INDEX
               && $context->phase === HookPhase::QUERY
               && $context->module === 'Product'
               && $context->timing === HookTiming::ON;
    }

    public function handle(HookContext $context): HookResult
    {
        $context->payload['query'] = $context->payload['query']
            ->addSelect(DB::raw("CASE 
        WHEN ProductRenew.is_renew = 1 THEN 'Renew'
        ELSE 'New'
    END AS is_renew"))
            ->leftJoin("ProductRenew","ProductRenew.product_id","=","products.id");
        if(!empty($context->payload['data']['is_renew'])) {
            $context->payload['query'] = $context->payload['query']
            ->where('ProductRenew.is_renew',
            $context->payload['data']['is_renew'] === 'New' ? false : true);
        }
        return HookResult::pass($context->payload);
    }
}
