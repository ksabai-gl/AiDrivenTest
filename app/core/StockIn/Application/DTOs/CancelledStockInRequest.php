<?php

namespace Core\StockIn\Application\DTOs;

class CancelledStockInRequest
{
    public function __construct(
        public int $business_id,
        public int $invoice_in_id,
        public int $created_by
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            business_id: (int) $data['business_id'],
            invoice_in_id: (int) $data['invoice_in_id'],
            created_by: $data['user_id']
        );
    }

    public function toArray(): array
    {
        return [
            'business_id' => $this->business_id,
            'invoice_in_id' => $this->invoice_in_id,
            'created_by'    => $this->created_by
        ];
    }
}
