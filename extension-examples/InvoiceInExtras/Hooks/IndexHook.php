<?php

namespace Extensions\InvoiceInExtras\Hooks;

use App\Supports\Hooks\HookContext;
use App\Contracts\Hooks\HookInterface;
use App\Exceptions\BadException;
use App\Supports\Hooks\HookAction;
use App\Supports\Hooks\HookPhase;
use App\Supports\Hooks\HookResult;
use App\Supports\Hooks\HookTiming;
use Extensions\InvoiceInExtras\Models\ExampleModel;
use Illuminate\Support\Facades\DB;

class IndexHook implements HookInterface
{
    public static function supports(HookContext $context): bool
    {
        return $context->action === HookAction::INDEX
               && $context->phase === HookPhase::QUERY
               && $context->module === 'InvoiceIn'
               && $context->timing === HookTiming::ON;
    }

    public function handle(HookContext $context): HookResult
    {
        $context->payload['query'] = $context->payload['query']
            ->addSelect(DB::raw('InvoiceInExtras.note as invoice_note'))
            ->leftJoin("InvoiceInExtras","InvoiceInExtras.invoicein_id","=","invoice_ins.id");
        if(!empty($context->payload['data']['invoice_note'])) {
            $context->payload['query'] = $context->payload['query']
            ->where('InvoiceInExtras.note','like','%'. $context->payload['data']['invoice_note'] .'%');
        }
        return HookResult::pass($context->payload);
    }
}
