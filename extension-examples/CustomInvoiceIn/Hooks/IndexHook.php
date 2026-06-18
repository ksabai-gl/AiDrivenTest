<?php

namespace Extensions\CustomInvoiceIn\Hooks;

use App\Supports\Hooks\HookContext;
use App\Contracts\Hooks\HookInterface;
use App\Exceptions\BadException;
use App\Supports\Hooks\HookAction;
use App\Supports\Hooks\HookPhase;
use App\Supports\Hooks\HookResult;
use App\Supports\Hooks\HookTiming;
use Extensions\CustomInvoiceIn\Models\ExampleModel;
use Illuminate\Support\Facades\DB;

class IndexHook implements HookInterface
{
    public static function supports(HookContext $context): bool
    {
        return $context->action === HookAction::INDEX
               && $context->phase === HookPhase::QUERY
               && $context->module === 'CustomInvoiceIn'
               && $context->timing === HookTiming::ON;
    }

    public function handle(HookContext $context): HookResult
    {
        $context->payload['query'] = $context->payload['query']
            ->addSelect(DB::raw('CustomInvoiceInExtra.note as note'))
            ->leftJoin("CustomInvoiceInExtra",
                "CustomInvoiceInExtra.custom_invoice_in","=","custom_invoice_ins.id");
        if(!empty($context->payload['data']['note'])) {
            $context->payload['query'] = $context->payload['query']
            ->where('CustomInvoiceInExtra.note','like','%'. $context->payload['data']['note'] .'%');
        }
        return HookResult::pass($context->payload);
    }
}
