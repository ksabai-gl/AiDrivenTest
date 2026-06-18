<?php

namespace Core\CustomerGroup\Domain\Entities;

class CustomerGroup
{
    public function __construct(
        public int $business_id,
        public string $name,
        public ?int $id = null,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            business_id: $data['business_id'],
            name: $data['name'],
            id: $data['id'] ?? null,
        );
    }

    public function toArray(): array
    {
        return [
            'id'          => $this->id,
            'business_id' => $this->business_id,
            'name'        => $this->name
        ];
    }
}
