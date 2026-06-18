<?php

namespace Core\OrderShipping\Infrastructure\Repositories;

use App\Models\ShippingModel;
use Core\OrderShipping\Domain\Repositories\OrderShippingRepositoryInterface;
use Core\OrderShipping\Domain\Entities\OrderShipping;

class EloquentOrderShippingRepository implements OrderShippingRepositoryInterface
{
    public function create(OrderShipping $entity): OrderShipping
    {
        $create = ShippingModel::create($entity->toArray());
        $entity->id = $create['id'];
        return $entity;
    }
    public function findById(array $data): ?OrderShipping
    {
        $row = ShippingModel::select("shippings.*")
        ->join("orders","orders.id","=","shippings.order_id")
        ->where('shippings.id',$data['id'])
        ->where('orders.business_id',$data['business_id'])
        ->where('orders.id',$data['order_id'])
        ->first()?->toArray();
        if(!$row) {
            return null;
        }
        return OrderShipping::fromArray($row);
    }
    public function findByIdWithFullData(array $data): ?array
    {
        $row = ShippingModel::select("shippings.*",
        "shipping_providers.name as shipping_provider_name")
        ->join("orders","orders.id","=","shippings.order_id")
        ->leftJoin("shipping_providers",
            "shipping_providers.id","=","shippings.preferred_unit")
        ->where('shippings.id',$data['id'])
        ->where('orders.business_id',$data['business_id'])
        ->where('orders.id',$data['order_id'])
        ->first()?->toArray();
        if(!$row) {
            return null;
        }
        return $row;
    }
    public function findByOrderId(array $data): ?OrderShipping
    {
        $row = ShippingModel::select("shippings.*")
        ->join("orders","orders.id","=","shippings.order_id")
        ->where('orders.business_id',$data['business_id'])
        ->where('orders.id',$data['order_id'])
        ->first()?->toArray();
        if(!$row) {
            return null;
        }
        return OrderShipping::fromArray($row);
    }
    public function update(OrderShipping $entity): OrderShipping
    {
        ShippingModel::where('id',$entity->id)
        ->where('order_id',$entity->order_id)
        ->update($entity->toArray());
        return $entity;
    }
    public function show(array $data): ?array
    {
        $row = ShippingModel::select("shippings.*",
            "shipping_providers.name as shipping_provider_name")
        ->leftJoin("shipping_providers","shipping_providers.id"
        ,"=","shippings.preferred_unit")
        ->join("orders","orders.id","=","shippings.order_id")
        ->where('shippings.id',$data['id'])
        ->where('orders.business_id',$data['business_id'])
        ->where('orders.id',$data['order_id'])
        ->first()?->toArray();
        if(!$row) {
            return null;
        }
        return $row;
    }
}