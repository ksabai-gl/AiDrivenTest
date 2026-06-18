<?php

namespace Extensions\InvoiceOutExtras\Hooks;
use App\Supports\Hooks\HookContext;
use App\Contracts\Hooks\HookInterface;
use App\Supports\Hooks\HookAction;
use App\Supports\Hooks\HookPhase;
use App\Supports\Hooks\HookResult;
use App\Supports\Hooks\HookTiming;
use Extensions\InvoiceOutExtras\Models\ExampleModel;

class UpdateHook implements HookInterface
{
    public static function supports(HookContext $context): bool
    {
        return $context->action === HookAction::UPDATE
            && $context->phase === HookPhase::RESPONSE
            && $context->module === 'InvoiceOut'
            && $context->timing === HookTiming::BEFORE;
    }

    public function handle(HookContext $context): HookResult
    {

        ExampleModel::updateOrInsert([
            'invoiceout_id' => $context->payload['id'],
        ],[
            'note' => $context->payload['invoice_note'],
            'invoiceout_id' => $context->payload['id'],
            'created_at' => date('Y-m-d H:i:s',time()),
            'updated_at' => date('Y-m-d H:i:s',time())
        ]);
        return HookResult::pass([
            ...$context->payload,
            'note' => 'required'
        ]);
    }
}