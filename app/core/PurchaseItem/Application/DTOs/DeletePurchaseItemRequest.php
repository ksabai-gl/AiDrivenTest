<?php

namespace Core\PurchaseItem\Application\DTOs;

class DeletePurchaseItemRequest
{
    public function __construct(
        public int $business_id,
        public int $user_id,
        public ?int $id = null
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            business_id: (int) $data['business_id'],
            user_id: (int) $data['user_id'],
            id: $data['id'] ?? null 
        );
    }

    public function toArray(): array
    {
        return [
            'business_id'            => $this->business_id,
            'user_id'                => $this->user_id,
            'id'    => $this->id
        ];
    }
}
