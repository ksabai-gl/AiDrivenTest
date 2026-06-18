<?php

namespace Core\CustomInvoiceIn\Application\DTOs;

class DeleteCustomInvoiceInRequest
{
    public function __construct(
        public int $business_id,
        public int $created_by,
        public int $id
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            business_id: (int) $data['business_id'],
            created_by: (int) $data['user_id'],
            id: (int) $data['id']
        );
    }

    public function toArray(): array
    {
        return [
            'business_id' => $this->business_id,
            'created_by' => $this->created_by,
            'id' => $this->id
        ];
    }
}
