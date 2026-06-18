<?php

namespace Core\PurchaseTax\Domain\Entities;

class PurchaseTax
{
    public function __construct(
        public int $tax,
        public int $id,
        public int $business_id,
        public int $user_id,
        public array $purchase_item_id
    ) {}
    public static function fromArray(array $data): self
    {
        return new self(
            tax: $data['tax'],
            id: $data['id'],
            business_id: $data['business_id'],
            user_id: $data['user_id'],
            purchase_item_id: $data['purchase_item_id']
        );
    }
    public function toArray() : array {
        return [
            'tax' => $this->tax,
            'id' => $this->id,
            'business_id' => $this->business_id,
            'user_id'     => $this->user_id,
            'purchase_item_id' => $this->purchase_item_id
        ];
    }
}