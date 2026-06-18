<?php

namespace Core\Product\Domain\Entities;

class Product
{
    public ?int $id;

    public function __construct(
        public int $business_id,
        public int $category_id,

        public string $sku,
        public string $name,
        public string $unit,

        public ?string $description = null,
        public ?string $image = null,
        public int $created_by
    ) {}

    /* ---------------------------------
     |  Factory: from array
     |---------------------------------*/
    public static function fromArray(array $data): self
    {
        $entity = new self(
            business_id:      $data['business_id'],
            category_id:      $data['category_id'],

            sku:              $data['sku'],
            name:             $data['name'],
            unit:             $data['unit'],

            description:      $data['description'] ?? null,
            image:            $data['image'] ?? null,
            created_by:       $data['created_by']
        );

        $entity->id = $data['id'] ?? null;

        return $entity;
    }

    /* ---------------------------------
     |  Convert to array
     |---------------------------------*/
    public function toArray(): array
    {
        return [
            'id'               => $this->id,
            'business_id'      => $this->business_id,
            'category_id'      => $this->category_id,

            'sku'              => $this->sku,
            'name'             => $this->name,
            'unit'             => $this->unit,

            'description'      => $this->description,
            'image'            => $this->image,
            'created_by'       => $this->created_by
        ];
    }
}
