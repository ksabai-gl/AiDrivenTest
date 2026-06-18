<?php

namespace Core\OrderShipping\Domain\Repositories;

use Core\OrderShipping\Domain\Entities\OrderShipping;

interface OrderShippingRepositoryInterface
{
    public function create(OrderShipping $entity): OrderShipping;
    public function findById(array $data): ?OrderShipping;
    public function findByIdWithFullData(array $data): ?array;
    public function findByOrderId(array $data): ?OrderShipping;
    public function show(array $data) : ?array;
    public function update(OrderShipping $entity) : OrderShipping;
}