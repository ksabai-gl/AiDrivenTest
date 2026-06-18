<?php

namespace Core\StockIn\Application\DTOs;

class CreateStockInRequest
{
    public function __construct(
        public int $business_id,
        public int $invoice_in_id,
        public ?int $approved_by,
        public ?string $import_date,
        public ?string $status,
        public ?int $created_by,
        public ?int $id = null
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            business_id: (int) $data['business_id'],
            invoice_in_id: (int) $data['invoice_in_id'],
            approved_by: $data['user_id'] ?? null,
            import_date: $data['import_date'] ?? null,
            status : $data['status'] ?? null,
            created_by: $data['user_id'],
            id: $data['id'] ?? null 
        );
    }

    public function toArray(): array
    {
        return [
            'business_id' => $this->business_id,
            'invoice_in_id' => $this->invoice_in_id,
            'approved_by' => $this->approved_by,
            'import_date' => $this->import_date,
            'status'      => $this->status,
            'created_by'  => $this->created_by,
            'id'          => $this->id
        ];
    }
}
