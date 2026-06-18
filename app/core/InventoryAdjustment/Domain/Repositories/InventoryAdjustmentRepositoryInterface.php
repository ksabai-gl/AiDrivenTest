<?php

namespace Core\InventoryAdjustment\Domain\Repositories;

use Core\InventoryAdjustment\Domain\Entities\InventoryAdjustment;

interface InventoryAdjustmentRepositoryInterface
{
    public function create(InventoryAdjustment $entity): InventoryAdjustment;
    public function index(array $data): array;
}