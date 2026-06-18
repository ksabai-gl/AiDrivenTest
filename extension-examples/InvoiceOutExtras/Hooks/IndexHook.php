<?php

namespace Extensions\InvoiceOutExtras\Hooks;

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
               && $context->module === 'InvoiceOut'
               && $context->timing === HookTiming::ON;
    }

    public function handle(HookContext $context): HookResult
    {
        $context->payload['query'] = $context->payload['query']
            ->addSelect(DB::raw('InvoiceOutExtras.note as invoice_note'))
            ->leftJoin("InvoiceOutExtras","InvoiceOutExtras.invoiceout_id",
                "=","invoice_outs.id");
        if(!empty($context->payload['data']['invoice_note'])) {
            $context->payload['query'] = $context->payload['query']
            ->where('InvoiceOutExtras.note','like'
                ,'%'. $context->payload['data']['invoice_note'] .'%');
        }
        return HookResult::pass($context->payload);
    }
}
