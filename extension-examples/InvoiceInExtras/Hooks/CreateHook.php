<?php

namespace Extensions\InvoiceInExtras\Hooks;
use App\Supports\Hooks\HookContext;
use App\Contracts\Hooks\HookInterface;
use App\Supports\Hooks\HookAction;
use App\Supports\Hooks\HookPhase;
use App\Supports\Hooks\HookResult;
use App\Supports\Hooks\HookTiming;
use Extensions\InvoiceInExtras\Models\InvoiceInExtrasModel;

class CreateHook implements HookInterface
{
    public static function supports(HookContext $context): bool
    {
        return $context->action === HookAction::CREATE
            && $context->phase === HookPhase::RESPONSE
            && $context->module === 'InvoiceIn'
            && $context->timing === HookTiming::AFTER;
    }

    public function handle(HookContext $context): HookResult
    {
        InvoiceInExtrasModel::create([
            'note' => 'No data',
            'invoicein_id' => $context->payload['id']
        ]);
        return HookResult::pass([
            ...$context->payload
        ]);
    }
}