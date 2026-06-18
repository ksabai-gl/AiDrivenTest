<?php

namespace Core\Inventory\Domain\Entities;

use Carbon\Carbon;

class Inventory
{
    public function __construct(
        public int $product_id,
        public int $warehouse_id,
        public float $quantity = 0,
        public float $reserved_qty = 0,
        public ?int $id = null
    ) {}

    public function getAvailable(): float
    {
        return $this->quantity - $this->reserved_qty;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            product_id: $data['product_id'],
            warehouse_id: $data['warehouse_id'],
            quantity: $data['quantity'] ?? 0,
            reserved_qty: $data['reserved_qty'] ?? 0,
            id: $data['id'] ?? null
        );
    }

    public function toArray(): array
    {
        return [
            'id'           => $this->id,
            'product_id'   => $this->product_id,
            'warehouse_id' => $this->warehouse_id,
            'quantity'     => $this->quantity,
            'reserved_qty' => $this->reserved_qty
        ];
    }
    public function quantityAvaiable(){
        return $this->quantity - $this->reserved_qty;
    }
    public function isCreate(){
        $this->reserved_qty = 0;
    }
    public function reservedQuantityCalculator(float $quantity)
    {
        $this->reserved_qty += $quantity;

        if ($this->reserved_qty < 0) {
            throw new \Exception("The reserved quantity can not be less than 0");
        }
    }

    public function quantityCalculator(float $quantity)
    {
        $this->quantity += $quantity;

        if ($this->quantity < 0) {
            throw new \Exception("The quantity in stock is not enough to reduce");
        }
    }

}
