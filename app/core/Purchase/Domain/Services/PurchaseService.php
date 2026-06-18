<?php

namespace Core\Purchase\Domain\Services;

use App\Exceptions\BadException;
use Core\Purchase\Domain\Entities\Purchase;

interface PurchaseService
{
    public function create(array $data): Purchase;
    public function show(array $data) : array | BadException;
    public function findOneById(array $data) : Purchase | BadException;
    public function update(array $data): Purchase | BadException;
}