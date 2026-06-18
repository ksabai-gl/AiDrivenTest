<?php

namespace Core\Overview\Domain\Repositories;

interface OverviewRepositoryInterface
{
    public function getCustomer(array $data): int;
    public function getPurchase(array $data): int;
    public function getOrder(array $data): int;
    public function getProduct(array $data): int;
    public function businessChart(array $data) : array;
    public function createCacheForMonth(array $data,int $business_id): array;
    public function getCacheForMonth(array $data): ?array;
    public function createCacheForYear(array $data, int $business_id): array;
    public function getCacheForYear(array $data): ?array;
    public function getExpenseByTime(array $data) : int;
    public function getRevenueByTime(array $data) : int;
    public function createCacheExpenseByTime(array $data,int $business_id) : void;
    public function createCacheRevenueByTime(array $data,int $business_id) : void;
    public function getCacheExpenseByTime(array $data) : ?array;
    public function getCacheRevenueByTime(array $data) : ?array;
}