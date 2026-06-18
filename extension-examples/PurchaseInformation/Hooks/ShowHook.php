<?php

namespace Extensions\PurchaseInformation\Hooks;

use App\Supports\Hooks\HookContext;
use App\Contracts\Hooks\HookInterface;
use App\Exceptions\BadException;
use App\Supports\Hooks\HookAction;
use App\Supports\Hooks\HookPhase;
use App\Supports\Hooks\HookResult;
use App\Supports\Hooks\HookTiming;
use Extensions\PurchaseInformation\Models\PurchaseInformationModel;
use Illuminate\Support\Facades\DB;

class ShowHook implements HookInterface
{
    public static function supports(HookContext $context): bool
    {
        return $context->action === HookAction::SHOW
               && $context->phase === HookPhase::RESPONSE
               && $context->module === 'Purchase'
               && $context->timing === HookTiming::AFTER;
    }

    public function handle(HookContext $context): HookResult
    {
        $row = PurchaseInformationModel::where('purchase_id',$context->payload['id'])->first()?->toArray();

        return HookResult::pass([
            ...$context->payload,
            'hotline' => $row ? $row['hotline'] : null
        ]);
    }
}
