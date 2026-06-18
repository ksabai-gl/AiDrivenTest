<?php

namespace Extensions\TrackingNumberOrderShipping\Hooks;

use App\Supports\Forms\FormFieldRender;
use App\Supports\Forms\FormFieldType;
use App\Supports\Hooks\HookContext;
use App\Contracts\Hooks\HookInterface;
use App\Supports\Hooks\HookAction;
use App\Supports\Hooks\HookPhase;
use App\Supports\Hooks\HookResult;
use App\Supports\Hooks\HookTiming;

class ViewShowHook implements HookInterface
{
    public static function supports(HookContext $context): bool
    {
        return $context->action === HookAction::SHOW
            && $context->phase === HookPhase::UI
            && $context->module === 'OrderShipping'
            && $context->timing === HookTiming::ON;
    }

    public function handle(HookContext $context): HookResult
    {
        $test = new FormFieldRender(
            type: FormFieldType::TEXT,
            value: '',
            key: 'tracking_number',
            label: 'Tracking number'
        );
        return HookResult::pass([
            ...$context->payload,
            $test->toArray()
        ]);
    }
}