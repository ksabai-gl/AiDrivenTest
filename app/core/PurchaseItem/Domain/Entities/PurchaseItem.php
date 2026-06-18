<?php

namespace Core\PurchaseItem\Domain\Entities;

class PurchaseItem
{
    public ?int $id = null;
    public bool $deleted = false;

    public function __construct(
        public int $purchase_id,
        public float $discount = 0,
        public float $tax = 0,
        public ?string $product_link = null,
        public float $buy_quantity = 0,
        public float $gift_quantity = 0,
        public float $compensation_quantity = 0,
        public float $conversion_quantity = 0,
        public int $unit_cost = 0,
        public int $product_id
    ) {}

    public static function fromArray(array $data): self
    {
        $entity = new self(
            purchase_id: (int) ($data['purchase_id'] ?? 0),
            discount: (float) ($data['discount'] ?? 0),
            tax: (float) ($data['tax'] ?? 0),
            product_link: $data['product_link'] ?? null,
            buy_quantity: (float) ($data['buy_quantity'] ?? 0),
            gift_quantity: (float) ($data['gift_quantity'] ?? 0),
            compensation_quantity: (float) ($data['compensation_quantity'] ?? 0),
            conversion_quantity: (float) ($data['conversion_quantity'] ?? 0),
            unit_cost: (int) ($data['unit_cost'] ?? 0),
            product_id: $data['product_id']
        );

        $entity->id = $data['id'] ?? null;

        return $entity;
    }

    public function toArray(): array
    {
        return [
            'id'                     => $this->id,
            'purchase_id'            => $this->purchase_id,
            'discount'               => $this->discount,
            'tax'                    => $this->tax,
            'product_link'           => $this->product_link,
            'buy_quantity'           => $this->buy_quantity,
            'gift_quantity'          => $this->gift_quantity,
            'compensation_quantity'  => $this->compensation_quantity,
            'conversion_quantity'    => $this->conversion_quantity,
            'unit_cost'              => $this->unit_cost,
            'product_id'             => $this->product_id
        ];
    }

    public function totalCost(): float
    {
        return $this->buy_quantity * $this->unit_cost;
    }

    public function totalAfterDiscountAndTax(): float
    {
        $subtotal = $this->totalCost();
        $afterDiscount = $subtotal - ($subtotal * $this->discount / 100);
        return $afterDiscount + ($afterDiscount * $this->tax / 100);
    }
    public function totalQuantity():float{
        return $this->buy_quantity
        + $this->gift_quantity
        + $this->compensation_quantity
        + $this->conversion_quantity;
    }
}
