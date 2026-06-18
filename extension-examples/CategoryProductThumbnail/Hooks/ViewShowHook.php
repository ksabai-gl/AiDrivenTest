<?php

namespace Extensions\CategoryProductThumbnail\Hooks;

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
            && $context->module === 'CategoryProduct'
            && $context->timing === HookTiming::ON;
    }

    public function handle(HookContext $context): HookResult
    {
        $form = new FormFieldRender(
            type: FormFieldType::IMAGE,
            value: '',
            key: 'thumbnail',
            label: 'Thumbnail'
        );
        return HookResult::pass([
            ...$context->payload,
            $form->toArray()
        ]);
    }
}