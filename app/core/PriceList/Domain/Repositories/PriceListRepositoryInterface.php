<?php

namespace Core\PriceList\Domain\Repositories;

use App\Exceptions\BadException;
use Core\PriceList\Domain\Entities\PriceList;

interface PriceListRepositoryInterface
{
    public function create(PriceList $entity): PriceList;
    public function update(PriceList $entity): PriceList;
    public function delete(PriceList $entity): PriceList;
    public function findByProductAndGroup(array $entity): ?PriceList;
    public function findById(array $data): ?PriceList;
    public function index(array $data) : array;
}