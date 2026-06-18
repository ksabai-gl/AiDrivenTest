<?php

namespace Core\StockOut\Application\DTOs;

class CreateStockOutRequest
{
    public function __construct(
        public int $business_id,
        public int $invoice_out_id,
        public ?int $approved_by = null,
        public ?int $id,
        public ?string $status = null,
        public ?int $created_by = null,
        public int $order_id
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            business_id: $data['business_id'],
            invoice_out_id: $data['invoice_out_id'],
            approved_by: $data['user_id'] ?? null,
            id: $data['id'] ?? null,
            status: $data['status'] ?? null,
            created_by: $data['user_id'] ?? null,
            order_id: $data['order_id']
        );
    }

    public function toArray(): array
    {
        return [
            'business_id'    => $this->business_id,
            'invoice_out_id' => $this->invoice_out_id,
            'approved_by'    => $this->approved_by,
            'id'             => $this->id,
            'status'         => $this->status,
            'created_by'     => $this->created_by,
            'order_id'  => $this->order_id
        ];
    }
}
