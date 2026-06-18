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
use Illuminate\Support\Facades\DB;

class IndexHook implements HookInterface
{
    public static function supports(HookContext $context): bool
    {
        return $context->action === HookAction::INDEX
               && $context->phase === HookPhase::QUERY
               && $context->module === 'Customer'
               && $context->timing === HookTiming::ON;
    }

    public function handle(HookContext $context): HookResult
    {
        $context->payload['query'] = $context->payload['query']
            ->addSelect(DB::raw('MAX(CustomerFax.fax) as fax'))
            ->leftJoin("CustomerFax","CustomerFax.customer_id","=","customers.id");
        if(!empty($context->payload['data']['fax'])) {
            $context->payload['query'] = $context->payload['query']
            ->where('CustomerFax.fax','like','%'. $context->payload['data']['fax'] .'%');
        }
        return HookResult::pass($context->payload);
    }
}
