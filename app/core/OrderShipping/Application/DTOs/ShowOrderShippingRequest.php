<?php

namespace Core\OrderShipping\Application\DTOs;

class ShowOrderShippingRequest
{
    public function __construct(
        public int $id,
        public int $order_id,
        public int $business_id,
        public ?int $created_by = null
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            id: $data['id'],
            order_id: $data['order_id'],
            business_id: $data['business_id'],
            created_by: $data['user_id']
        );
    }

    public function toArray(): array
    {
        return [
            'id'    => $this->id,
            'order_id'               => $this->order_id,
            'business_id'   => $this->business_id,
            'created_by'    => $this->created_by
        ];
    }
}
