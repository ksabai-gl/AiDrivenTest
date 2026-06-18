<?php

namespace Core\InvoiceIn\Infrastructure\Repositories;

use App\Models\InvoiceInModel;
use Core\InvoiceIn\Domain\Repositories\InvoiceInRepositoryInterface;
use Core\InvoiceIn\Domain\Entities\InvoiceIn;

class EloquentInvoiceInRepository implements InvoiceInRepositoryInterface
{
    public function create(InvoiceIn $entity): InvoiceIn
    {
        // TODO: Add actual database logic
        $create = InvoiceInModel::create($entity->toArray());
        $entity->id = $create['id'];
        return $entity;
    }
    public function all(array $data): array
    {
        $list = InvoiceInModel::select(
            "invoice_ins.*",
            "suppliers.unit_name as unit_name",
            "suppliers.email as email",
            "suppliers.phone as phone",
            "suppliers.address as address",
            "suppliers.tax_code as tax_code",
            "suppliers.bank_name as bank_name",
            "suppliers.bank_account as bank_account",
            "suppliers.website as website",
            "suppliers.note as note",
            "purchases.status as purchase_status"
        )
            ->join("purchases", "purchases.id", "=", "invoice_ins.purchase_id")
            ->join("suppliers", "suppliers.id", "=", "purchases.supplier_id")
            ->where('invoice_ins.business_id', $data['business_id']);
            if(!empty($data['keywords'])) {
                $list = $list->where('invoice_ins.document_no','like','%'. $data['keywords'] .'%');
            }
            if(!empty($data['payment_status'])) {
                $list = $list->where('invoice_ins.payment_status',$data['payment_status']);
            }
            return $list->orderBy("invoice_ins.id",$data['order_by'])->paginate(15)->toArray();
    }
    public function checkExists(array $data): bool {
        return InvoiceInModel::select("invoice_ins.*")
        ->join("purchases", "purchases.id", "=", "invoice_ins.purchase_id")
        ->join("suppliers", "suppliers.id", "=", "purchases.supplier_id")
        ->where('invoice_ins.business_id', $data['business_id'])
        ->where('purchases.deleted_at',NULL)
        ->where('invoice_ins.document_no',$data['document_no'])->count() >= 1 ? true : false;
    }
    public function findById(array $data) : ?InvoiceIn {
        $row = InvoiceInModel::where('id',$data['id'])
        ->where('business_id',$data['business_id'])->first()?->toArray();
        if(!$row) {
            return null;
        }
        return InvoiceIn::fromArray($row);
    }
    public function findByPurchaseId(array $data) : ?InvoiceIn {
        $row = InvoiceInModel::where('purchase_id',$data['purchase_id'])
        ->where('business_id',$data['business_id'])->first()?->toArray();
        if(!$row) {
            return null;
        }
        return InvoiceIn::fromArray($row);
    }
    public function findByIdWithFullData(array $data): ?array
    {
        return InvoiceInModel::select(
            "invoice_ins.*",
            "suppliers.unit_name as unit_name",
            "suppliers.email as email",
            "suppliers.phone as phone",
            "suppliers.address as address",
            "suppliers.tax_code as tax_code",
            "suppliers.bank_name as bank_name",
            "suppliers.bank_account as bank_account",
            "suppliers.website as website",
            "suppliers.note as note",
            "purchases.payment_method as payment_method",
            "purchases.expected_date as expected_date",
            "purchases.shipping_fee as shipping_fee"
        )
            ->join("purchases", "purchases.id", "=", "invoice_ins.purchase_id")
            ->join("suppliers", "suppliers.id", "=", "purchases.supplier_id")
            ->where('invoice_ins.business_id', $data['business_id'])
            ->where('invoice_ins.id',$data['id'])
            ->first()?->toArray();
    }
    public function update(InvoiceIn $entity): InvoiceIn {
        InvoiceInModel::where('id',$entity->id)
        ->where('business_id',$entity->business_id)
        ->update($entity->toArray());
        return $entity;
    }
}
