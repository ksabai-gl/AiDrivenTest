<?php

namespace Core\PurchaseCancel\Infrastructure\Repositories;

use App\Models\PurchaseCancelModel;
use Core\PurchaseCancel\Domain\Repositories\PurchaseCancelRepositoryInterface;
use Core\PurchaseCancel\Domain\Entities\PurchaseCancel;

class EloquentPurchaseCancelRepository implements PurchaseCancelRepositoryInterface
{
    public function create(PurchaseCancel $entity): PurchaseCancel
    {
        $create = PurchaseCancelModel::create($entity->toArray());
        $entity->id = $create['id'];
        return $entity;
    }
}