<?php

namespace Core\PurchaseCancel\Domain\Repositories;

use Core\PurchaseCancel\Domain\Entities\PurchaseCancel;

interface PurchaseCancelRepositoryInterface
{
    public function create(PurchaseCancel $entity): PurchaseCancel;
}