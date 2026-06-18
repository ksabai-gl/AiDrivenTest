<?php

namespace Core\PriceList\Infrastructure\Repositories;

use App\Models\PriceListModel;
use Core\PriceList\Domain\Repositories\PriceListRepositoryInterface;
use Core\PriceList\Domain\Entities\PriceList;

class EloquentPriceListRepository implements PriceListRepositoryInterface
{
    public function create(PriceList $entity): PriceList
    {
        $create = PriceListModel::create($entity->toArray());
        $entity->id = $create['id'];
        return $entity;
    }
    public function update(PriceList $entity): PriceList
    {
        PriceListModel::where('id',$entity->id)
        ->update($entity->toArray());
        return $entity;
    }
    public function findByProductAndGroup(array $data): ?PriceList
    {
        $row = PriceListModel::where('customer_group_id',$data['customer_group_id'])
        ->where('product_id',$data['product_id'])
        ->first()?->toArray();
        if(!$row) {
            return null;
        }
        return PriceList::fromArray($row);
    }
    public function findById(array $data): ?PriceList
    {
        $row = PriceListModel::where('id',$data['id'])
        ->first()?->toArray();
        if(!$row) {
            return null;
        }
        return PriceList::fromArray($row);
    }
    public function index(array $data): array{
        $rows = PriceListModel::select("price_list.*",
        "products.name as name",
        "customer_group.name as group")
        ->join("products","products.id","=","price_list.product_id")
        ->join("customer_group","customer_group.id","=","price_list.customer_group_id")
        ->where("products.business_id",$data['business_id']);
        if(!empty($data['keywords'])) {
            $rows = $rows->where('products.name','like','%'.$data['keywords'].'%');
        }
        return $rows->paginate(15)->toArray();
    }
    public function delete(PriceList $entity): PriceList
    {
        PriceListModel::where('id',$entity->id)
        ->delete();
        return $entity;
    }
}