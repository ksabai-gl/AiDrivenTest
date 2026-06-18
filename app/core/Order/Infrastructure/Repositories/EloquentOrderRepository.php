<?php

namespace Core\Order\Infrastructure\Repositories;

use App\Models\OrderModel;
use Core\Order\Domain\Repositories\OrderRepositoryInterface;
use Core\Order\Domain\Entities\Order;
use Illuminate\Support\Facades\DB;

class EloquentOrderRepository implements OrderRepositoryInterface
{

    public function create(Order $entity): Order
    {
        $create = OrderModel::create($entity->toArray());
        $entity->id = $create['id'];
        return $entity;
    }
    public function findById(array $data): ?Order
    {
        $row = OrderModel::where('id', $data['id'])
            ->where('business_id', $data['business_id'])->first()?->toArray();
        if (!$row) {
            return null;
        }
        return Order::fromArray($row);
    }
    public function findByOrderNo(array $data): ?Order
    {
        $row = OrderModel::where('business_id', $data['business_id'])
            ->where('order_no', $data['order_no'])
            ->first()?->toArray();
        if (!$row) {
            return null;
        }
        return Order::fromArray($row);
    }
    public function findByIdWithData(array $data): ?array
    {
        $row = OrderModel::select("orders.*",
            "customers.name as customer_name",
            "shippings.id as shipping_id",
            "shippings.receiver_name as receiver_name",
            "shippings.receiver_phone as receiver_phone",
            "shippings.receiver_address as receiver_address",
            "shippings.receiver_note as receiver_note",
            "shippings.preferred_unit as preferred_unit",
            "shippings.shipping_fee_estimated as shipping_fee_estimated",
            "shippings.shipping_unit as shipping_unit",
            "shippings.shipping_code as shipping_code",
            "orders.id as order_id",
            "customers.group as customer_group_id",
            "order_cancelled_reason.reason as reason")
            ->join("shippings","shippings.order_id","=","orders.id")
            ->leftJoin("order_cancelled_reason","order_cancelled_reason.order_id",
            "=","orders.id")
            ->join("customers","customers.id",
                "=","orders.customer_id")
            ->where('orders.id', $data['id'])
            ->where('orders.business_id', $data['business_id'])->first()?->toArray();
        if (!$row) {
            return null;
        }
        return $row;
    }
    public function update(Order $entity): Order
    {
        OrderModel::where('id', $entity->id)
            ->where('business_id', $entity->business_id)
            ->update($entity->toArray());
        return $entity;
    }
}
