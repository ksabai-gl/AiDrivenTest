<?php

namespace Core\CustomerGroup\Domain\Services;

use App\Exceptions\BadException;
use Core\CustomerGroup\Domain\Entities\CustomerGroup;

interface CustomerGroupService
{
    public function create(array $data): CustomerGroup;
    public function show(array $data) : CustomerGroup | BadException;
    public function update(array $data) : CustomerGroup | BadException;
    public function index(array $data) : array;
    public function delete(array $data) : CustomerGroup | BadException;
}