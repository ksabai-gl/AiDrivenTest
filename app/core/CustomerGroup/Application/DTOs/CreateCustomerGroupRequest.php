<?php

namespace Core\CustomerGroup\Application\DTOs;

class CreateCustomerGroupRequest
{
    public function __construct(
        public int $business_id,
        public string $name,
        public int $created_by,
        public ?int $id
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            business_id: $data['business_id'],
            name: $data['name'],
            created_by: $data['user_id'] ?? null,
            id: $data['id'] ?? null
        );
    }

    public function toArray(): array
    {
        return [
            'business_id' => $this->business_id,
            'name' => $this->name,
            'created_by' => $this->created_by,
            'id'    => $this->id
        ];
    }
}
