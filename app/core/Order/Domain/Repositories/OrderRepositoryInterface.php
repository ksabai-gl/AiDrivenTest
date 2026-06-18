<?php

namespace Core\Order\Domain\Repositories;

use Core\Order\Domain\Entities\Order;

interface OrderRepositoryInterface
{
    public function create(Order $entity): Order;
    public function findById(array $data) : ?Order;
    public function findByOrderNo(array $data) : ?Order;
    public function update(Order $data) : Order;
    public function findByIdWithData(array $data): ?array;
}