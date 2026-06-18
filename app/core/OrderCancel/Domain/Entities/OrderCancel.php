<?php

namespace Core\OrderCancel\Domain\Entities;

class OrderCancel
{
    public function __construct(
        public int $created_by,
        public ?string $reason = null,
        public int $order_id,
        public ?int $id = null
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            created_by: $data['created_by'],
            reason: $data['reason'] ?? null,
            order_id: $data['order_id'],
            id: $data['id'] ?? null 
        );
    }
    public function toArray(): array
    {
        return [
            'created_by' => $this->created_by,
            'reason' => $this->reason,
            'order_id' => $this->order_id,
            'id'    => $this->id
        ];
    }
}