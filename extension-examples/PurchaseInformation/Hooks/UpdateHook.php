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

class UpdateHook implements HookInterface
{
    public static function supports(HookContext $context): bool
    {
        return $context->action === HookAction::UPDATE
            && $context->phase === HookPhase::RESPONSE
            && $context->module === 'Purchase'
            && $context->timing === HookTiming::AFTER;
    }

    public function handle(HookContext $context): HookResult
    {
        if($context->payload['status'] === 'draft') {
            if(empty($context->payload['hotline'])) {
                throw new BadException(__("PurchaseInformation.Hotline is required"));
            }
            PurchaseInformationModel::updateOrInsert([
                'purchase_id' => $context->payload['id'],
            ],[
                'hotline' => $context->payload['status'] !== 'approved' 
                    ? $context->payload['hotline'] : '',
                'purchase_id' => $context->payload['id'],
                'created_at' => date('Y-m-d H:i:s',time()),
                'updated_at' => date('Y-m-d H:i:s',time())
            ]);    
        }
        
        return HookResult::pass([
            ...$context->payload
        ]);
    }
}