<?php

namespace Core\Overview\Application\UseCases;

use App\Supports\Hooks\HookAction;
use App\Supports\Hooks\HookContext;
use App\Supports\Hooks\HookDispatcher;
use App\Supports\Hooks\HookPhase;
use App\Supports\Hooks\HookTiming;
use Core\Business\Application\UseCases\AllBusiness;
use Core\Overview\Application\DTOs\CreateOverviewRequest;
use Core\Overview\Domain\Services\OverviewService;
use Illuminate\Support\Facades\Concurrency;

class CreateOverview
{
    public function __construct(
        private OverviewService $service,
        private HookDispatcher $hooks
    ) {}

    public function handle(AllBusiness $AllBusiness)
    {
        foreach ($AllBusiness->handle() as $key => $value) {
            $this->hooks->dispatch(
                new HookContext(
                    action: HookAction::CREATE,
                    phase: HookPhase::RESPONSE,
                    timing: HookTiming::BEFORE,
                    payload: $value,
                    module: 'Overview'
                )
            );
            $dto = CreateOverviewRequest::fromArray(['business_id' => $value['id']]);
            if (env('ENV') !== 'production') {
                $this->service->createCacheForMonth($dto->toArray());
                $this->service->createCacheForYear($dto->toArray());
                $this->service->createRevenueByTime($dto->toArray());
                $this->service->createExpenseByTime($dto->toArray());
            } else {
                Concurrency::driver('fork')->run([
                    fn() => $this->service
                        ->createCacheForMonth($dto->toArray()),
                    fn() => $this->service->createCacheForYear($dto->toArray()),
                    fn() => $this->service->createRevenueByTime($dto->toArray()),
                    fn() => $this->service->createExpenseByTime($dto->toArray())
                ]);
            }
            $this->hooks->dispatch(
                new HookContext(
                    action: HookAction::CREATE,
                    phase: HookPhase::RESPONSE,
                    timing: HookTiming::AFTER,
                    payload: $value,
                    module: 'Overview'
                )
            );
        }
        return [];
    }
}
