<?php

namespace Core\Warehouse\Domain\Entities;

class Warehouse
{
    public function __construct(
        public ?int $id = null,
        public string $name,
        public string $address,
        public int $business_id,
        public bool $active = true,
        public ?int $created_by
    ) {}

    /**
     * Activate warehouse
     */
    public function setActive(): void
    {
        $this->active = true;
    }

    /**
     * Deactivate warehouse
     */
    public function setDeActive(): void
    {
        $this->active = false;
    }

    /**
     * Create entity from array
     */
    public static function fromArray(array $data): self
    {
        return new self(
            id: $data['id'] ?? null,
            name: $data['name'],
            address: $data['address'],
            business_id: $data['business_id'],
            active: $data['active'] ?? true,
            created_by: $data['created_by']
        );
    }

    /**
     * Convert entity to array
     */
    public function toArray(): array
    {
        return [
            'id'          => $this->id,
            'name'        => $this->name,
            'address'     => $this->address,
            'business_id' => $this->business_id,
            'active'      => $this->active,
            'created_by'  => $this->created_by
        ];
    }
}
