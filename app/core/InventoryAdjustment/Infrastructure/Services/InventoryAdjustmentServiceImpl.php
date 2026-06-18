<?php

namespace Core\InventoryAdjustment\Infrastructure\Services;

use Core\InventoryAdjustment\Domain\Services\InventoryAdjustmentService;
use Core\InventoryAdjustment\Domain\Repositories\InventoryAdjustmentRepositoryInterface;
use Core\InventoryAdjustment\Domain\Entities\InventoryAdjustment;

class InventoryAdjustmentServiceImpl implements InventoryAdjustmentService
{
    public function __construct(private InventoryAdjustmentRepositoryInterface $repo) {}

    public function create(array $data): InventoryAdjustment
    {
        $entity = InventoryAdjustment::fromArray($data);

        return $this->repo->create($entity);
    }
    public function index(array $data): array
    {
        return $this->repo->index($data);
    }
}