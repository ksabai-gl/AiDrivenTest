<?php

namespace Core\Product\Application\DTOs;

class CreateProductRequest
{
    
    public function __construct(
        public int $business_id,
        public ?int $category_id = 0,
        public string $sku,
        public string $name,
        public string $unit = 'pcs',
        public ?string $description = null,
        public ?string $image = null,
        public int $created_by,
        public ?int $id = null,
        
    ) {}
    public static function fromArray(array $data): self
    {
        return new self(
            business_id: (int) $data['business_id'],
            category_id: $data['category_id'] ?? 0,
            sku: $data['sku'],
            name: $data['name'],
            unit: $data['unit'] ?? 'pcs',
            description: $data['description'] ?? null,
            image: $data['image'] ?? null,
            id: $data['id'] ?? null,
            created_by: $data['user_id'],
        );
    }
    public function toArray(): array
    {
        return [
            'business_id'            => $this->business_id,
            'category_id'            => $this->category_id ?? 0,
            'sku'                    => $this->sku,
            'name'                   => $this->name,
            'unit'                   => $this->unit,
            'description'            => $this->description,
            'image'                  => $this->image,
            'created_by'             => $this->created_by,
            'id'    => $this->id
        ];
    }
}
