<?php

namespace Core\OrderCancel\Application\DTOs;

class CreateOrderCancelRequest
{
    public function __construct(
        public int $created_by,
        public ?string $reason = null,
        public int $order_id
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            created_by: $data['user_id'],
            reason: $data['reason'] ?? null,
            order_id: $data['order_id']
        );
    }
    public function toArray(): array
    {
        return [
            'created_by' => $this->created_by,
            'reason' => $this->reason,
            'order_id' => $this->order_id
        ];
    }
}