<?php

namespace Core\ActivityLog\Application\UseCases;

use Core\ActivityLog\Domain\Services\ActivityLogService;

class IndexActivityLog
{
    public function __construct(private ActivityLogService $service) {}

    public function handle(array $dto)
    {
        return $this->service->index($dto);
    }
}