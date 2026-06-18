<?php

namespace Core\InvoiceIn\Application\DTOs;

class ChangeToUnapprovedRequest
{
    public function __construct(
        public int $business_id,
        public int $purchase_id,
        public int $created_by
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            business_id: $data['business_id'],
            purchase_id: $data['purchase_id'],
            created_by: $data['user_id'] ?? null 
        );
    }

    public function toArray(): array
    {
        return [
            'business_id' => $this->business_id,
            'purchase_id' => $this->purchase_id,
            'created_by'    => $this->created_by
        ];
    }
}
