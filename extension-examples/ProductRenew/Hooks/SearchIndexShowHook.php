<?php

namespace Extensions\ProductRenew\Hooks;

use App\Supports\Forms\IndexFieldType;
use App\Supports\Hooks\HookContext;
use App\Contracts\Hooks\HookInterface;
use App\Supports\Forms\IndexFieldRender;
use App\Supports\Forms\SearchFieldType;
use App\Supports\Forms\SearchIndexRender;
use App\Supports\Hooks\HookAction;
use App\Supports\Hooks\HookPhase;
use App\Supports\Hooks\HookResult;
use App\Supports\Hooks\HookTiming;

class SearchIndexShowHook implements HookInterface
{
    public static function supports(HookContext $context): bool
    {
        return $context->action === HookAction::SEARCH
            && $context->phase === HookPhase::UI
            && $context->module === 'Product'
            && $context->timing === HookTiming::ON;
    }

    public function handle(HookContext $context): HookResult
    {
        $th = new SearchIndexRender(
            type: SearchFieldType::SELECT,
            label: 'Renew',
            options: [
                [
                    "value" => 1,
                    "label" => 'Renew'
                ],
                [
                    "value" => 0,
                    "label" => 'New'
                ]
                ],
                placeholder: 'Search renew',
                key: 'is_renew'
        );
        return HookResult::pass([
            ...$context->payload,
            $th->toArray()
        ]);
    }
}