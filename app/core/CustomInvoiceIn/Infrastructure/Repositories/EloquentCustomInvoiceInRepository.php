<?php

namespace Core\CustomInvoiceIn\Infrastructure\Repositories;

use App\Models\CustomInvoiceInModel;
use Core\CustomInvoiceIn\Domain\Repositories\CustomInvoiceInRepositoryInterface;
use Core\CustomInvoiceIn\Domain\Entities\CustomInvoiceIn;

class EloquentCustomInvoiceInRepository implements CustomInvoiceInRepositoryInterface
{
    public function create(CustomInvoiceIn $entity): CustomInvoiceIn
    {
        $create = CustomInvoiceInModel::create($entity->toArray());
        $entity->id = $create['id'];
        return $entity;
    }
    public function update(CustomInvoiceIn $entity): CustomInvoiceIn
    {
        CustomInvoiceInModel::where('id',$entity->id)
        ->update($entity->toArray());
        return $entity;
    }
    public function findByDocumentNo(array $data): ?CustomInvoiceIn
    {
        $row = CustomInvoiceInModel::where('document_no',$data['document_no'])
        ->where('business_id',$data['business_id'])
        ->first()?->toArray();
        if(!$row) {
            return null;
        }
        return CustomInvoiceIn::fromArray($row);
    }
    public function findById(array $data): ?CustomInvoiceIn
    {
        $row = CustomInvoiceInModel::where('id',$data['id'])
        ->where('business_id',$data['business_id'])
        ->first()?->toArray();
        if(!$row) {
            return null;
        }
        return CustomInvoiceIn::fromArray($row);
    }
    public function delete(CustomInvoiceIn $entity): CustomInvoiceIn
    {
        CustomInvoiceInModel::where('id',$entity->id)
        ->delete();
        return $entity;
    }
}