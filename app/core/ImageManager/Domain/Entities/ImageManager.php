<?php

namespace Core\ImageManager\Domain\Entities;

class ImageManager
{
    public function __construct(
        public string $path,
        public int $created_by,
        public int $business_id,
        public ?int $id = null
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            path: $data['path'],
            created_by: $data['created_by'],
            business_id: $data['business_id'],
            id: $data['id'] ?? null 
        );
    }
    public function toArray(){
        return [
            'path' => $this->path,
            'created_by' => $this->created_by,
            'business_id' => $this->business_id,
            'id'    => $this->id
        ];
    }
}