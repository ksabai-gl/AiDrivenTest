<?php

namespace Core\Overview\Domain\Services;

use Core\Overview\Domain\Entities\Overview;

interface OverviewService
{
    public function index(array $data): array;
    public function createCacheForMonth(array $data): array;
    public function createCacheForYear(array $data): array;
    public function createRevenueByTime(array $data): void;
    public function createExpenseByTime(array $data): void;
}