<?php

namespace Extensions\PriceListCountry\Hooks;

use App\Supports\Forms\IndexFieldType;
use App\Supports\Hooks\HookContext;
use App\Contracts\Hooks\HookInterface;
use App\Supports\Forms\IndexFieldRender;
use App\Supports\Forms\SearchFieldType;
use App\Supports\Forms\SearchIndexRender;
use App\Supports\Hooks\HookAction;
use App\Supports\Hooks\HookPhase;
use App\Supports\Hooks\HookResult;
use App\Supports\Hooks\HookTiming;

class SearchIndexHook implements HookInterface
{
    public static function supports(HookContext $context): bool
    {
        return $context->action === HookAction::SEARCH
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
        $th = new SearchIndexRender(
            type: SearchFieldType::SELECT,
            label: 'Country',
            options: $options,
            placeholder: 'Search country',
            key: 'country'
        );
        return HookResult::pass([
            ...$context->payload,
            $th->toArray()
        ]);
    }
}
