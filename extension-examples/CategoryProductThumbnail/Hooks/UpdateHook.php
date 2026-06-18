<?php

namespace Extensions\CategoryProductThumbnail\Hooks;

use App\Supports\Hooks\HookContext;
use App\Contracts\Hooks\HookInterface;
use App\Supports\Hooks\HookAction;
use App\Supports\Hooks\HookPhase;
use App\Supports\Hooks\HookResult;
use App\Supports\Hooks\HookTiming;
use Extensions\CategoryProductThumbnail\Models\CategoryProductThumbnailModel;

class UpdateHook implements HookInterface
{
    public static function supports(HookContext $context): bool
    {
        return $context->action === HookAction::UPDATE
            && $context->phase === HookPhase::RESPONSE
            && $context->module === 'CategoryProduct'
            && $context->timing === HookTiming::AFTER;
    }

    public function handle(HookContext $context): HookResult
    {
        $create = CategoryProductThumbnailModel::updateOrInsert([
            'category_product_id' => $context->payload['id']
        ],[
            'thumbnail' => $context->payload['thumbnail'],
            'category_product_id' => $context->payload['id'],
            'created_at' => date('Y-m-d H:i:s',time()),
            'updated_at' => date('Y-m-d H:i:s',time()),
        ]);
        return HookResult::pass([
            ...$context->payload,
            'thumbnail' => $create
        ]);
    }
}