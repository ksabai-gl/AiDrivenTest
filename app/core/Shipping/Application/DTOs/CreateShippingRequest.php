<?php

namespace Core\Shipping\Application\DTOs;

class CreateShippingRequest
{
    public function __construct(
        public string $name,
        public string $code,
        public ?string $logo = null,
        public ?bool $active = true,
        public int $business_id,
        public ?int $id = null,
        public ?int $created_by = null  
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            name:   $data['name'],
            code:   $data['code'],
            logo:   $data['logo'] ?? null,
            active: $data['active'] ?? false,
            business_id: (int) $data['business_id'] ?? null,
            id: $data['id'] ?? null,
            created_by: $data['user_id'] ?? null 
        );
    }

    public function toArray(): array
    {
        return [
            'name'   => $this->name,
            'code'   => $this->code,
            'logo'   => $this->logo,
            'active' => $this->active,
            'business_id' => $this->business_id,
            'id'     => $this->id,
            'created_by'    => $this->created_by
        ];
    }
}