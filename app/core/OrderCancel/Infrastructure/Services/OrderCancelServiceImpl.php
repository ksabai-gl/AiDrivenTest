<?php

namespace Core\OrderCancel\Infrastructure\Services;

use Core\OrderCancel\Domain\Services\OrderCancelService;
use Core\OrderCancel\Domain\Repositories\OrderCancelRepositoryInterface;
use Core\OrderCancel\Domain\Entities\OrderCancel;

class OrderCancelServiceImpl implements OrderCancelService
{
    public function __construct(private OrderCancelRepositoryInterface $repo) {}

    public function create(array $data): OrderCancel
    {
        $entity = OrderCancel::fromArray($data);

        return $this->repo->create($entity);
    }
}