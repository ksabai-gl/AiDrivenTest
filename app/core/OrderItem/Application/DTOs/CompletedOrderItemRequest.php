<?php

namespace Core\OrderItem\Application\DTOs;

class CompletedOrderItemRequest
{
    public function __construct(
        public int $business_id,
        public int $order_id,
        public int $created_by,
        public int $stock_out_id
    ) {}

    /**
     * Create DTO from array input
     */
    public static function fromArray(array $data): self
    {
        return new self(
            order_id: $data['order_id'],
            business_id: $data['business_id'],
            created_by: $data['user_id'],
            stock_out_id: $data['stock_out_id']
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
            'created_by' => $this->created_by,
            'stock_out_id'  => $this->stock_out_id
        ];
    }
}
