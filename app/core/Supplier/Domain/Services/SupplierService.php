<?php

namespace Core\Supplier\Domain\Services;

use App\Exceptions\BadException;
use Core\Supplier\Domain\Entities\Supplier;

interface SupplierService
{
    public function create(array $data): Supplier | BadException;
    public function update(array $data): Supplier | BadException;
    public function delete(array $data): Supplier | BadException;
}