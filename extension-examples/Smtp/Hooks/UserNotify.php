<?php

namespace Extensions\Smtp\Hooks;

use App\Supports\Hooks\HookContext;
use App\Contracts\Hooks\HookInterface;
use App\Supports\Hooks\HookAction;
use App\Supports\Hooks\HookPhase;
use App\Supports\Hooks\HookResult;
use App\Supports\Hooks\HookTiming;

class UserNotify implements HookInterface
{
    public static function supports(HookContext $context): bool
    {
        return $context->action === HookAction::CREATE
            && $context->phase === HookPhase::RESPONSE
            && $context->timing === HookTiming::BEFORE
            && $context->module === 'UserNotify';
    }

    public function handle(HookContext $context): HookResult
    {
        return HookResult::pass($context->payload);
    }
}