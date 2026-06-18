<?php

namespace Core\OrderCancel\Infrastructure\Repositories;

use App\Models\OrderCancelModel;
use Core\OrderCancel\Domain\Repositories\OrderCancelRepositoryInterface;
use Core\OrderCancel\Domain\Entities\OrderCancel;

class EloquentOrderCancelRepository implements OrderCancelRepositoryInterface
{
    public function create(OrderCancel $entity): OrderCancel
    {
        $create = OrderCancelModel::create($entity->toArray());
        $entity->id = $create['id'];
        return $entity;
    }
}