<?php

namespace Extensions\InvoiceOutExtras\Hooks;
use App\Supports\Hooks\HookContext;
use App\Contracts\Hooks\HookInterface;
use App\Supports\Hooks\HookAction;
use App\Supports\Hooks\HookPhase;
use App\Supports\Hooks\HookResult;
use App\Supports\Hooks\HookTiming;
use Extensions\InvoiceOutExtras\Models\ExampleModel;

class CreateHook implements HookInterface
{
    public static function supports(HookContext $context): bool
    {
        return $context->action === HookAction::CREATE
            && $context->phase === HookPhase::RESPONSE
            && $context->module === 'InvoiceOut'
            && $context->timing === HookTiming::AFTER;
    }

    public function handle(HookContext $context): HookResult
    {
        ExampleModel::create([
            'note' => 'No data',
            'invoiceout_id' => $context->payload['id']
        ]);
        return HookResult::pass([
            ...$context->payload,
            'note' => 'No data'
        ]);
    }
}