<?php

namespace Core\PurchaseItem\Application\DTOs;

class CheckForPurchaseRequestedRequest
{
    public function __construct(
        public int $business_id,
        public int $purchase_id,
        public int $created_by
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            business_id: (int) $data['business_id'],
            purchase_id: $data['purchase_id'],
            created_by: $data['user_id']
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
