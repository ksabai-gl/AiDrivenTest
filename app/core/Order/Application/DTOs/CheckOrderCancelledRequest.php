<?php

namespace Core\Order\Application\DTOs;

class CheckOrderCancelledRequest
{
    public function __construct(
        public int $business_id,
        public ?int $id,
    ) {}

    /**
     * Build DTO from array
     */
    public static function fromArray(array $data): self
    {
        return new self(
            business_id:             $data['business_id'],
            id:                      $data['id'] ?? null
        );
    }

    /**
     * Convert to array (for Entity or Repository)
     */
    public function toArray(): array
    {
        return [
            'business_id'            => $this->business_id,
            'id' => $this->id
        ];
    }
}
