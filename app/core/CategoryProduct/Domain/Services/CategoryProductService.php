<?php

namespace Core\CategoryProduct\Domain\Services;

use App\Exceptions\BadException;
use Core\CategoryProduct\Domain\Entities\CategoryProduct;

interface CategoryProductService
{
    public function create(array $data): CategoryProduct | BadException;
    public function show(array $data) : CategoryProduct | BadException;
    public function update(array $data): CategoryProduct | BadException;
    public function delete(array $data): CategoryProduct | BadException;
}