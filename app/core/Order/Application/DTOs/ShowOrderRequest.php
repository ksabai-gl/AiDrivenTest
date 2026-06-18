<?php

namespace Core\Order\Application\DTOs;

class ShowOrderRequest
{
    public function __construct(
        public int $business_id,
        public int $id,
        public int $created_by
    ) {}

    /**
     * Build DTO from array
     */
    public static function fromArray(array $data): self
    {
        return new self(
            business_id: $data['business_id'],
            created_by: $data['user_id'],
            id: $data['id'],
        );
    }

    /**
     * Convert to array (for Entity or Repository)
     */
    public function toArray(): array
    {
        return [
            'business_id'            => $this->business_id,
            'created_by' => $this->created_by,
            'id' => $this->id
        ];
    }
}
