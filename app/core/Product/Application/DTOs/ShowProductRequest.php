<?php

namespace Core\Product\Application\DTOs;

class ShowProductRequest
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
            created_by: $data['user_id'],
            id: $data['id']
        );
    }
    public function toArray(): array
    {
        return [
            'business_id'            => $this->business_id,
            'created_by'             => $this->created_by,
            'id'    => $this->id
        ];
    }
}
