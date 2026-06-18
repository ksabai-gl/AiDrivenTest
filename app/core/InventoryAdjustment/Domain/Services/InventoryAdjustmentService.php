<?php

namespace Core\InventoryAdjustment\Domain\Services;

use Core\InventoryAdjustment\Domain\Entities\InventoryAdjustment;

interface InventoryAdjustmentService
{
    public function create(array $data): InventoryAdjustment;
    public function index(array $data): array;
}