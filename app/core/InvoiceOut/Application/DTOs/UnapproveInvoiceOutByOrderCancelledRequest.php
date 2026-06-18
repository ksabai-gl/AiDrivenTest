<?php

namespace Core\InvoiceOut\Application\DTOs;

class UnapproveInvoiceOutByOrderCancelledRequest
{
    public function __construct(
        public int $business_id,
        public int $order_id,
        public ?int $created_by 
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            business_id: $data['business_id'],
            order_id: $data['order_id'],
            created_by: $data['user_id']
        );
    }

    public function toArray(): array
    {
        return [
            'business_id'  => $this->business_id,
            'order_id'     => $this->order_id,
            'created_by'   => $this->created_by 
        ];
    }
}
