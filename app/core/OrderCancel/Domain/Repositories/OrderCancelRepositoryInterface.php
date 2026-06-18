<?php

namespace Core\OrderCancel\Domain\Repositories;

use Core\OrderCancel\Domain\Entities\OrderCancel;

interface OrderCancelRepositoryInterface
{
    public function create(OrderCancel $entity): OrderCancel;
}