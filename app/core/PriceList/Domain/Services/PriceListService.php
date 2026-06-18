<?php

namespace Core\PriceList\Domain\Services;

use App\Exceptions\BadException;
use Core\PriceList\Domain\Entities\PriceList;

interface PriceListService
{
    public function create(array $data): PriceList | BadException;
    public function update(array $data): PriceList | BadException;
    public function delete(array $data): PriceList | BadException;
    public function findByProductAndGroup(array $data): PriceList | BadException;
    public function index(array $data): array;
}