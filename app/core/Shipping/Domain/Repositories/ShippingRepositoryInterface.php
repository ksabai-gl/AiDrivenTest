<?php

namespace Core\Shipping\Domain\Repositories;

use Core\Shipping\Domain\Entities\Shipping;

interface ShippingRepositoryInterface
{
    public function create(Shipping $entity): Shipping;
    public function findById(array $data) : ?Shipping;
    public function findByName(array $data) : ?Shipping;
    public function update(Shipping $entity) : Shipping;
    public function delete(Shipping $entity) : Shipping;
}