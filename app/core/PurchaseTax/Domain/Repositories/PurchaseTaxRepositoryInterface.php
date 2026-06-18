<?php

namespace Core\PurchaseTax\Domain\Repositories;

use Core\PurchaseTax\Domain\Entities\PurchaseTax;

interface PurchaseTaxRepositoryInterface
{
    public function create(PurchaseTax $entity): PurchaseTax;
}