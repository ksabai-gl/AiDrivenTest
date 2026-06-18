<?php
namespace Core\Supplier\Application\UseCases;

use App\Supports\Hooks\HookAction;
use App\Supports\Hooks\HookContext;
use App\Supports\Hooks\HookDispatcher;
use App\Supports\Hooks\HookPhase;
use App\Supports\Hooks\HookTiming;
class ViewSupplier
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
                module: 'Supplier'
            )
        );
        $index = $this->hooks->dispatch(
            new HookContext(
                action: HookAction::INDEX,
                phase: HookPhase::UI,
                timing: HookTiming::ON,
                payload: $data,
                module: 'Supplier'
            )
        );
        $search = $this->hooks->dispatch(
            new HookContext(
                action: HookAction::SEARCH,
                phase: HookPhase::UI,
                timing: HookTiming::ON,
                payload: $data,
                module: 'Supplier'
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