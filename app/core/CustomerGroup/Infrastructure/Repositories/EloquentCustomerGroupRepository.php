<?php

namespace Core\CustomerGroup\Infrastructure\Repositories;

use App\Models\CustomerGroupModel;
use Core\CustomerGroup\Domain\Repositories\CustomerGroupRepositoryInterface;
use Core\CustomerGroup\Domain\Entities\CustomerGroup;

class EloquentCustomerGroupRepository implements CustomerGroupRepositoryInterface
{
    public function create(CustomerGroup $entity): CustomerGroup
    {
        $create = CustomerGroupModel::create($entity->toArray());
        $entity->id = $create['id'];
        return $entity;
    }
    public function index(array $data): array
    {
        return CustomerGroupModel::where('business_id',$data['business_id'])
        ->where('name','like','%'. ($data['keywords'] ?? '') .'%')
        ->paginate(15)->toArray();
    }
    public function findById(array $data): ?CustomerGroup
    {
        $row = CustomerGroupModel::where('id',$data['id'])
        ->where('business_id',$data['business_id'])->first()?->toArray();
        if(!$row) {
            return null;
        }
        return CustomerGroup::fromArray($row);
    }
    public function update(CustomerGroup $entity): CustomerGroup
    {
        CustomerGroupModel::where('id',$entity->id)
        ->where('business_id',$entity->business_id)->update($entity->toArray());
        return $entity;
    }
    public function delete(CustomerGroup $entity): CustomerGroup
    {
        CustomerGroupModel::where('id',$entity->id)
        ->where('business_id',$entity->business_id)
        ->delete();
        return $entity;
    }
}