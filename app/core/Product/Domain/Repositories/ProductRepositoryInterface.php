<?php

namespace Core\Product\Domain\Repositories;

use Core\Product\Domain\Entities\Product;

interface ProductRepositoryInterface
{
    public function create(Product $entity): Product;
    public function checkExists(array $data) : ?Product;
    public function findOneWithFullData(array $data) : ?array;
    public function update(Product $entity): Product;
    public function delete(Product $entity): Product;
    public function findById(array $data): ?Product;
}