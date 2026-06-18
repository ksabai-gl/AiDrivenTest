<?php

namespace Core\Purchase\Domain\Repositories;

use Core\Purchase\Domain\Entities\Purchase;

interface PurchaseRepositoryInterface
{
    public function create(Purchase $entity): Purchase;
    public function findById(array $data) : ?Purchase;
    public function findByIdWithFullData(array $data) : ?array;
    public function update(Purchase $entity): Purchase;
}