<?php

namespace Core\Shipping\Infrastructure\Repositories;

use App\Models\ShippingProviderModel;
use Core\Shipping\Domain\Repositories\ShippingRepositoryInterface;
use Core\Shipping\Domain\Entities\Shipping;

class EloquentShippingRepository implements ShippingRepositoryInterface
{
    public function create(Shipping $entity): Shipping
    {
        // TODO: Add actual database logic
        $create = ShippingProviderModel::create($entity->toArray());
        $entity->id = $create['id'];
        return $entity;
    }
    public function findById(array $data): ?Shipping
    {
        $row = ShippingProviderModel::where('business_id',$data['business_id'])
        ->where('id',$data['id'])->first()?->toArray();
        if(!$row) {
            return null;
        }
        return Shipping::fromArray($row);
    }
    public function update(Shipping $entity): Shipping
    {
        ShippingProviderModel::where('business_id',$entity->business_id)
        ->where('id',$entity->id)->update($entity->toArray());
        return $entity;
    }
    public function findByName(array $data): ?Shipping
    {
        $row = ShippingProviderModel::where('business_id',$data['business_id'])
        ->where('name',$data['name'])->first()?->toArray();
        if(!$row) {
            return null;
        }
        return Shipping::fromArray($row);
    }
    public function delete(Shipping $entity): Shipping
    {
        ShippingProviderModel::where('business_id',$entity->business_id)
        ->where('id',$entity->id)->delete();
        return $entity;
    }
}