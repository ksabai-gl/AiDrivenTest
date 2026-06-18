<?php

namespace Core\Shipping\Application\DTOs;

class ShowShippingRequest
{
    public function __construct(
        public int $business_id,
        public ?int $id = null,
        public ?int $created_by = null  
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            business_id: (int) $data['business_id'] ?? null,
            id: $data['id'] ?? null,
            created_by: $data['user_id'] ?? null 
        );
    }

    public function toArray(): array
    {
        return [
            'business_id' => $this->business_id,
            'id'     => $this->id,
            'created_by'    => $this->created_by
        ];
    }
}