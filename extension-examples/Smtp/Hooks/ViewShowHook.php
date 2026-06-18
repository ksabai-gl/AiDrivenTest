<?php

namespace Extensions\Smtp\Hooks;

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
            && $context->timing === HookTiming::ON;
    }

    public function handle(HookContext $context): HookResult
    {
        $form = new FormFieldRender(
            type: FormFieldType::TEXT,
            value: '',
            key: 'fax',
            label: 'Fax'
        );
        return HookResult::pass([
            ...$context->payload,
            $form->toArray()
        ]);
    }
}