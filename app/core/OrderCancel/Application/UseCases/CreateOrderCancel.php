<?php

namespace Core\OrderCancel\Application\UseCases;

use Core\OrderCancel\Application\DTOs\CreateOrderCancelRequest;
use Core\OrderCancel\Domain\Services\OrderCancelService;

class CreateOrderCancel
{
    public function __construct(private OrderCancelService $service) {}

    public function handle(CreateOrderCancelRequest $dto)
    {
        return $this->service->create($dto->toArray());
    }
}