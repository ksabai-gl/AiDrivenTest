<?php

namespace Extensions\SupplierFax\Hooks;

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
            && $context->phase === HookPhase::RESPONSE
            && $context->module === 'Supplier'
            && $context->timing === HookTiming::ON;
    }

    public function handle(HookContext $context): HookResult
    {
        $context->payload['query'] = $context->payload['query']
        ->leftJoin("SupplierFax","SupplierFax.supplier_id","=","suppliers.id")
        ->addSelect("SupplierFax.fax");
        if(!empty($context->payload['data']['fax'])) {
            $context->payload['query'] = $context->payload['query']
                ->where('SupplierFax.fax','like','%'. $context->payload['data']['fax'] .'%');
        }
        return HookResult::pass([
            ...$context->payload 
        ]);
    }
}