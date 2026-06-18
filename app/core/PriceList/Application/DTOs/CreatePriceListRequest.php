<?php

namespace Core\PriceList\Application\DTOs;

class CreatePriceListRequest
{
    public function __construct(
        public int $customer_group_id,
        public int $product_id,
        public float $price,
        public int $created_by,
        public int $business_id,
        public ?int $id
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            customer_group_id: $data['customer_group_id'],
            product_id: $data['product_id'],
            price: $data['price'],
            created_by: $data['user_id'] ?? null,
            business_id: $data['business_id'] ?? null,
            id: $data['id'] ?? null 
        );
    }

    public function toArray(): array
    {
        return [
            'customer_group_id' => $this->customer_group_id,
            'product_id'        => $this->product_id,
            'price'             => $this->price,
            'created_by'        => $this->created_by,
            'business_id'       => $this->business_id,
            'id'    => $this->id
        ];
    }
}
