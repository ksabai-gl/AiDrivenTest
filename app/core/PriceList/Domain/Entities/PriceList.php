<?php

namespace Core\PriceList\Domain\Entities;

class PriceList
{
    public ?int $id;

    public function __construct(
        public int $customer_group_id,
        public int $product_id,
        public float $price,
        ?int $id = null
    ) {
        $this->id = $id;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            customer_group_id: (int) $data['customer_group_id'],
            product_id: (int) $data['product_id'],
            price: (float) $data['price'],
            id: $data['id'] ?? null
        );
    }

    public function toArray(): array
    {
        return [
            'id'                => $this->id,
            'customer_group_id' => $this->customer_group_id,
            'product_id'        => $this->product_id,
            'price'             => $this->price,
        ];
    }
}
