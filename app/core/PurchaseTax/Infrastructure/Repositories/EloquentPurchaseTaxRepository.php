<?php

namespace Core\PurchaseTax\Infrastructure\Repositories;

use App\Models\PurchaseItemModel;
use Core\PurchaseTax\Domain\Repositories\PurchaseTaxRepositoryInterface;
use Core\PurchaseTax\Domain\Entities\PurchaseTax;

class EloquentPurchaseTaxRepository implements PurchaseTaxRepositoryInterface
{
    public function create(PurchaseTax $entity): PurchaseTax
    {
        PurchaseItemModel::whereIn('id',$entity->purchase_item_id)
        ->update(['tax' => $entity->tax]);
        return $entity;
    }
}