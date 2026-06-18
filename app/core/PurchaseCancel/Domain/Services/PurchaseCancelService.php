<?php

namespace Core\PurchaseCancel\Domain\Services;

use Core\PurchaseCancel\Domain\Entities\PurchaseCancel;

interface PurchaseCancelService
{
    public function create(array $data): PurchaseCancel;
}