<?php

namespace Core\ImageManager\Application\DTOs;

class CreateImageManagerRequest
{
    public function __construct(
        public \Illuminate\Http\UploadedFile $file,
        public int $business_id,
        public ?int $id = null,
        public int $created_by,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            file: $data['file'],
            business_id: $data['business_id'],
            id: $data['id'] ?? null,
            created_by: $data['user_id'] 
        );
    }
    public function toArray(){
        return [
            'file' => $this->file,
            'business_id' => $this->business_id,
            'id'    => $this->id,
            'created_by' => $this->created_by
        ];
    }
}