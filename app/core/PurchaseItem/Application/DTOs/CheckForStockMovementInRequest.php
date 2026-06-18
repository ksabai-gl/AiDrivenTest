<?php

namespace Core\PurchaseItem\Application\DTOs;

class CheckForStockMovementInRequest
{
    public function __construct(
        public int $business_id,
        public int $id,
        public int $created_by,
        public int $qty_change
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            business_id: (int) $data['business_id'],
            id: $data['id'],
            created_by: $data['user_id'],
            qty_change: $data['qty_change']
        );
    }

    public function toArray(): array
    {
        return [
            'business_id' => $this->business_id,
            'id' => $this->id,
            'created_by'    => $this->created_by,
            'qty_change'    => $this->qty_change
        ];
    }
}
