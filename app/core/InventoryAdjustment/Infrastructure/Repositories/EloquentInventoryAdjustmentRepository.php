<?php

namespace Core\InventoryAdjustment\Infrastructure\Repositories;

use App\Models\InventoryAdjustmentModel;
use Core\InventoryAdjustment\Domain\Repositories\InventoryAdjustmentRepositoryInterface;
use Core\InventoryAdjustment\Domain\Entities\InventoryAdjustment;

class EloquentInventoryAdjustmentRepository implements InventoryAdjustmentRepositoryInterface
{
    public function create(InventoryAdjustment $entity): InventoryAdjustment
    {
        $create = InventoryAdjustmentModel::create($entity->toArray());
        $entity->id = $create['id'];
        return $entity;
    }
    public function index(array $data): array
    {
        $rows = InventoryAdjustmentModel::select("inventory_adjustments.*",
            "warehouses.name as warehouse",
            "products.name as product_name",
            "users.name as created_by")
        ->join("warehouses","warehouses.id","=","inventory_adjustments.warehouse_id")
        ->join("products","products.id","=","inventory_adjustments.product_id")
        ->join("users","users.id","=","inventory_adjustments.adjusted_by")
        ->where('warehouses.business_id',$data['business_id']);
        if(!empty($data['warehouse_id'])) {
            $rows = $rows->where('inventory_adjustments.warehouse_id',$data['warehouse_id']);
        }
        if(!empty($data['product_id'])) {
            $rows = $rows->where('inventory_adjustments.warehouse_id',$data['product_id']);
        }
        if(!empty($data['keywords'])) {
            $rows = $rows->where('products.name',$data['keywords']);
        }
        return $rows->paginate(15)->toArray();
    }
}