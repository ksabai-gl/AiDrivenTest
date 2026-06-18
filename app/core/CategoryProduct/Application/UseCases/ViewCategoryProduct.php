<?php

namespace Core\CategoryProduct\Application\UseCases;

use App\Supports\Hooks\HookAction;
use App\Supports\Hooks\HookContext;
use App\Supports\Hooks\HookDispatcher;
use App\Supports\Hooks\HookPhase;
use App\Supports\Hooks\HookTiming;

class ViewCategoryProduct
{
    public function __construct(private HookDispatcher $hooks) {}

    public function handle(array $data)
    {
        $form = $this->hooks->dispatch(
            new HookContext(
                action: HookAction::SHOW,
                phase: HookPhase::UI,
                timing: HookTiming::ON,
                payload: $data,
                module: 'CategoryProduct'
            )
        );
        $index = $this->hooks->dispatch(
            new HookContext(
                action: HookAction::INDEX,
                phase: HookPhase::UI,
                timing: HookTiming::ON,
                payload: $data,
                module: 'CategoryProduct'
            )
        );
        $search = $this->hooks->dispatch(
            new HookContext(
                action: HookAction::SEARCH,
                phase: HookPhase::UI,
                timing: HookTiming::ON,
                payload: $data,
                module: 'CategoryProduct'
            )
        );
        return [
            'form' => [
                ...$form
            ],
            'index' => [
                ...$index
            ],
            'search' => $search
        ];
    }
}