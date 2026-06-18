<?php

namespace Core\Supplier\Domain\Repositories;

use Core\Supplier\Domain\Entities\Supplier;

interface SupplierRepositoryInterface
{
    public function create(Supplier $entity): Supplier;
    public function update(Supplier $entity): Supplier;
    public function findById(array $data) : ?Supplier;
    public function findByName(array $data) : ?Supplier;
    public function delete(Supplier $entity): Supplier;
}