<?php

namespace Core\Purchase\Infrastructure\Repositories;

use App\Models\PurchaseModel;
use Core\Purchase\Domain\Repositories\PurchaseRepositoryInterface;
use Core\Purchase\Domain\Entities\Purchase;
use Illuminate\Support\Facades\DB;

class EloquentPurchaseRepository implements PurchaseRepositoryInterface
{
    public function create(Purchase $entity): Purchase
    {
        // TODO: Add actual database logic
        $entity->setDraft();
        $create = PurchaseModel::create($entity->toArray());
        $entity->id = $create['id'];
        return $entity;
    }
    public function findById(array $data): ?Purchase
    {
        $row = PurchaseModel::where('business_id', $data['business_id'])
            ->where('id', $data['id'])->first()?->toArray();
        if (!$row) {
            return null;
        }
        return Purchase::fromArray($row);
    }
    public function findByIdWithFullData(array $data): ?array
    {
        return PurchaseModel::select(
            "purchases.*",
            "suppliers.unit_name as supplier_name",
            "purchase_cancelled_reason.reason as reason",
            DB::raw("SUM(purchase_items.buy_quantity) as buy_quantity"),
            DB::raw("SUM(purchase_items.gift_quantity) as gift_quantity"),
            DB::raw("SUM(purchase_items.compensation_quantity) as compensation_quantity"),
            DB::raw("SUM(purchase_items.conversion_quantity) as conversion_quantity"),
            DB::raw("SUM(purchase_items.conversion_quantity) 
            + SUM(purchase_items.gift_quantity)
            + SUM(purchase_items.compensation_quantity)
            + SUM(purchase_items.buy_quantity) as quantity"),
            DB::raw("ROUND(SUM((purchase_items.unit_cost * purchase_items.buy_quantity) 
                * purchase_items.tax / 100), 2) AS total_tax"),
            DB::raw("SUM(purchase_items.unit_cost * purchase_items.buy_quantity) as subtotal"),
            DB::raw("ROUND(
            SUM((purchase_items.unit_cost * purchase_items.buy_quantity) 
            + ((purchase_items.unit_cost * purchase_items.buy_quantity) * purchase_items.tax / 100) )
            + purchases.shipping_fee
            ,2) as total")
        )
            ->join("suppliers", "suppliers.id", "=", "purchases.supplier_id")
            ->leftJoin("purchase_items", "purchase_items.purchase_id", "=", "purchases.id")
            ->leftJoin(
                "purchase_cancelled_reason",
                "purchase_cancelled_reason.purchase_id",
                "=",
                "purchases.id"
            )
            ->where('purchases.business_id', $data['business_id'])
            ->where('purchases.id', $data['id'])
            ->groupBy("purchases.id", "purchase_cancelled_reason.id")
            ->first()?->toArray();
    }
    public function update(Purchase $entity): Purchase
    {
        PurchaseModel::where('business_id', $entity->business_id)
            ->where('id', $entity->id)->update($entity->toArray());
        return $entity;
    }
}
