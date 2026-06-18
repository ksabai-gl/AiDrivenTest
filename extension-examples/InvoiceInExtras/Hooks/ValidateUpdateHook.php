<?php

namespace Extensions\InvoiceInExtras\Hooks;
use App\Supports\Hooks\HookContext;
use App\Contracts\Hooks\HookInterface;
use App\Exceptions\BadException;
use App\Supports\Hooks\HookAction;
use App\Supports\Hooks\HookPhase;
use App\Supports\Hooks\HookResult;
use App\Supports\Hooks\HookTiming;

class ValidateUpdateHook implements HookInterface
{
    public static function supports(HookContext $context): bool
    {
        return $context->action === HookAction::UPDATE
            && $context->phase === HookPhase::VALIDATE
            && $context->module === 'InvoiceIn'
            && $context->timing === HookTiming::ON;
    }

    public function handle(HookContext $context): HookResult
    {
        return HookResult::pass([
            ...$context->payload,
            'invoice_note' => 'required'
        ]);
    }
}