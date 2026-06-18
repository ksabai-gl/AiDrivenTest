<?php

namespace Extensions\PriceListCountry\Hooks;

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
            && $context->module === 'PriceList'
            && $context->timing === HookTiming::ON;
    }

    public function handle(HookContext $context): HookResult
    {
        $options = [];
        foreach (config('pricelistcountry.countries') as $key => $value) {
            $options[$key] = [
                'value' => $value,
                'label' => $value
            ];
        }
        $form = new FormFieldRender(
            type: FormFieldType::SELECT,
            value: '',
            key: 'country',
            label: 'Country',
            options: $options
        );
        return HookResult::pass([
            ...$context->payload,
            $form->toArray()
        ]);
    }
}
