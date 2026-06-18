<?php

namespace Core\Warehouse\Application\DTOs;

class CreateWarehouseRequest
{
    public function __construct(
        public string $name,
        public string $address,
        public int $business_id,
        public ?string $role = null,
        public ?int $created_by = null,
        public ?int $id = null,
        public bool $active
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            name: $data['name'],
            address: $data['address'],
            business_id: $data['business_id'],
            role: $data['role'] ?? null,
            created_by: $data['user_id'] ?? null,
            id: $data['id'] ?? null,
            active: $data['active'] ?? false
        );
    }
    public function toArray(): array
    {
        return [
            'name'        => $this->name,
            'address'     => $this->address,
            'business_id' => $this->business_id,
            'role'        => $this->role,
            'created_by' => $this->created_by,
            'id'         => $this->id,
            'active'     => $this->active
        ];
    }
}
