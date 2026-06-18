<?php

namespace Extensions\CustomInvoiceIn\Hooks;
use App\Supports\Hooks\HookContext;
use App\Contracts\Hooks\HookInterface;
use App\Supports\Hooks\HookAction;
use App\Supports\Hooks\HookPhase;
use App\Supports\Hooks\HookResult;
use App\Supports\Hooks\HookTiming;
use Extensions\CustomInvoiceIn\Models\ExampleModel;

class CreateHook implements HookInterface
{
    public static function supports(HookContext $context): bool
    {
        return $context->action === HookAction::CREATE
            && $context->phase === HookPhase::RESPONSE
            && $context->module === 'CustomInvoiceIn'
            && $context->timing === HookTiming::AFTER;
    }

    public function handle(HookContext $context): HookResult
    {
        ExampleModel::updateOrInsert([
            'custom_invoice_in' => $context->payload['id'],
        ],[
            'note' => $context->payload['note'],
            'custom_invoice_in' => $context->payload['id'],
            'created_at' => date('Y-m-d H:i:s',time()),
            'updated_at' => date('Y-m-d H:i:s',time())
        ]);
        return HookResult::pass([
            ...$context->payload
        ]);
    }
}