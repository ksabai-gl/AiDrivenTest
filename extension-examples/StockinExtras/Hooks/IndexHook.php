<?php

namespace Extensions\StockinExtras\Hooks;

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
               && $context->module === 'StockIn'
               && $context->timing === HookTiming::ON;
    }

    public function handle(HookContext $context): HookResult
    {
        $context->payload['query'] = $context->payload['query']
            ->addSelect(DB::raw('MAX(StockinExtras.note) as stock_note'))
            ->leftJoin("StockinExtras","StockinExtras.stockin_id"
                ,"=","stock_ins.id");
        if(!empty($context->payload['data']['stock_note'])) {
            $context->payload['query'] = $context->payload['query']
            ->where('StockinExtras.note','like',
                '%'. $context->payload['data']['stock_note'] .'%');
        }
        return HookResult::pass($context->payload);
    }
}
