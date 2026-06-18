<?php

namespace Core\Order\Application\UseCases;

use Core\Order\Application\DTOs\IndexOrderRequest;
use Core\Order\Domain\Services\OrderService;

class FindOrderOneById
{
    public function __construct(private OrderService $service) {}

    public function handle(IndexOrderRequest $dto)
    {
        return $this->service->findOneById($dto->toArray());
    }
}