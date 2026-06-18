<?php

namespace Core\PurchaseCancel\Domain\Entities;

class PurchaseCancel
{
    public function __construct(
        public int $purchase_id,
        public ?string $reason = null,
        public int $created_by,
        public ?int $id = null 
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            purchase_id: $data['purchase_id'],
            reason: $data['reason'] ?? null,
            created_by: $data['created_by'],
            id: $data['id'] ?? null  
        );
    }
    public function toArray(): array
    {
        return [
            'purchase_id' => $this->purchase_id,
            'reason'    => $this->reason,
            'created_by' => $this->created_by,
            'id'        => $this->id
        ];
    }
}