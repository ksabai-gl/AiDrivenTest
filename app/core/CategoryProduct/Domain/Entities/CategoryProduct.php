<?php

namespace Core\CategoryProduct\Domain\Entities;

class CategoryProduct
{
    public ?int $id;

    public function __construct(
        public string $name,
        public int $business_id,
        public ?string $description = null,
        public int $created_by,
        public int $tax
    ) {}
    public function toArray(): array
    {
        return [
            'id' => $this->id ?? null,
            'name' => $this->name,
            'business_id' => $this->business_id,
            'description' => $this->description,
            'created_by' => $this->created_by,
            'tax'   => $this->tax
        ];
    }
    public static function fromArray(array $data): self
    {
        $entity = new self(
            name: $data['name'],
            business_id: (int) $data['business_id'],
            description: $data['description'] ?? null,
            created_by: $data['created_by'],
            tax: $data['tax']
        );

        $entity->id = $data['id'] ?? null;

        return $entity;
    }
}
