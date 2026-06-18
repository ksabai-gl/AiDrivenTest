<?php

namespace Core\CustomerGroup\Domain\Repositories;

use Core\CustomerGroup\Domain\Entities\CustomerGroup;

interface CustomerGroupRepositoryInterface
{
    public function create(CustomerGroup $entity): CustomerGroup;
    public function findById(array $data) : ?CustomerGroup;
    public function update(CustomerGroup $entity): CustomerGroup;
    public function index(array $data) : array;
    public function delete(CustomerGroup $entity): CustomerGroup;
}