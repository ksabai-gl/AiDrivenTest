<?php

namespace Core\CategoryProduct\Application\DTOs;

class DeleteCategoryProductRequest
{
    public function __construct(
        public int $id,
        public int $created_by,
        public int $business_id
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            id: $data['id'],
            business_id: $data['business_id'],
            created_by: $data['user_id'] ?? null
        );
    }
    public function toArray() : array {
        return [
            'id' => $this->id,
            'business_id' => $this->business_id,
            'created_by' => $this->created_by,
        ];
    }
}