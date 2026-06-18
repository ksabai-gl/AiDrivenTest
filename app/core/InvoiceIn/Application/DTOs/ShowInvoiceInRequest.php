<?php

namespace Core\InvoiceIn\Application\DTOs;

class ShowInvoiceInRequest
{
    public function __construct(
        public int $business_id,
        public int $id,
        public int $created_by
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            business_id: $data['business_id'],
            id: $data['id'],
            created_by: $data['user_id'] ?? null 
        );
    }

    public function toArray(): array
    {
        return [
            'business_id' => $this->business_id,
            'id' => $this->id,
            'created_by'    => $this->created_by
        ];
    }
}
