<?php

namespace Extensions\CategoryProductThumbnail\Hooks;

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
            && $context->module === 'CategoryProduct'
            && $context->timing === HookTiming::ON;
    }

    public function handle(HookContext $context): HookResult
    {
        $context->payload['query'] = $context->payload['query']
        ->leftJoin("CategoryProductThumbnail",
            "CategoryProductThumbnail.category_product_id","=","category_product.id")
        ->addSelect("CategoryProductThumbnail.thumbnail");
        if(!empty($context->payload['data']['tax'])) {
            $context->payload['query'] = $context->payload['query']
                ->where('category_product.tax',$context->payload['data']['tax']);
        }
        return HookResult::pass([
            ...$context->payload 
        ]);
    }
}