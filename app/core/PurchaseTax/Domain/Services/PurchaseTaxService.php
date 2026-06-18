<?php

namespace Core\PurchaseTax\Domain\Services;

use Core\PurchaseTax\Domain\Entities\PurchaseTax;

interface PurchaseTaxService
{
    public function create(array $data): PurchaseTax;
}