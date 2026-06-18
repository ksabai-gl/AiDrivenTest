<?php

namespace Core\OrderItem\Application\DTOs;

class CancelledOrderItemRequest
{
    public function __construct(
        public int $business_id,
        public int $order_id,
        public int $created_by
    ) {}

    /**
     * Create DTO from array input
     */
    public static function fromArray(array $data): self
    {
        return new self(
            order_id: $data['order_id'],
            business_id: $data['business_id'],
            created_by: $data['user_id']
        );
    }

    /**
     * Convert DTO to array (Repository or Entity)
     */
    public function toArray(): array
    {
        return [
            'order_id'              => $this->order_id,
            'business_id' => $this->business_id,
            'created_by' => $this->created_by
        ];
    }
}
