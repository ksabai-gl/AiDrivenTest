<?php

namespace Core\Supplier\Infrastructure\Repositories;

use App\Models\SupplierModel;
use Core\Supplier\Domain\Repositories\SupplierRepositoryInterface;
use Core\Supplier\Domain\Entities\Supplier;

class EloquentSupplierRepository implements SupplierRepositoryInterface
{
    public function create(Supplier $entity): Supplier
    {
        $create = SupplierModel::create($entity->toArray());
        $entity->id = $create['id'];
        return $entity;
    }
    public function findById(array $data): ?Supplier
    {
        $row = SupplierModel::where('id',$data['id'])
        ->where('business_id',$data['business_id'])->first()?->toArray();
        if(!$row) {
            return null;
        }
        return Supplier::fromArray($row);
    }
    public function findByName(array $data): ?Supplier
    {
        $row = SupplierModel::where('unit_name',$data['unit_name'])
        ->where('business_id',$data['business_id'])->first()?->toArray();
        if(!$row) {
            return null;
        }
        return Supplier::fromArray($row);
    }
    public function update(Supplier $entity): Supplier
    {
        SupplierModel::where('id',$entity->id)
        ->where('business_id',$entity->business_id)->update($entity->toArray());
        return $entity;
    }
    public function delete(Supplier $entity): Supplier
    {
        SupplierModel::where('id',$entity->id)
        ->where('business_id',$entity->business_id)
        ->delete();
        return $entity;
    }
}
