<?php

namespace Core\ActivityLog\Application\UseCases;

use Core\ActivityLog\Application\DTOs\CreateActivityLogRequest;
use Core\ActivityLog\Domain\Services\ActivityLogService;

class CreateActivityLog
{
    public function __construct(private ActivityLogService $service) {}

    public function handle(CreateActivityLogRequest $dto)
    {
        return $this->service->create($dto->toArray());
    }
}