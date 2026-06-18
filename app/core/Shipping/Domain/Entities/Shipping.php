<?php

namespace Core\Shipping\Domain\Entities;

class Shipping
{
    public function __construct(
        public ?int $id,
        public string $name,
        public string $code,
        public ?string $logo = null,
        public bool $active = false,
        public int $business_id,
    ) {}

    /**
     * Convert array (DB / DTO) → Entity
     */
    public static function fromArray(array $data): self
    {
        return new self(
            id: $data['id'] ?? null,
            name: $data['name'],
            code: $data['code'],
            logo: $data['logo'] ?? null,
            active: $data['active'] ?? true,
            business_id: $data['business_id']
        );
    }

    /**
     * Convert Entity → array (để repo lưu DB)
     */
    public function toArray(): array
    {
        return [
            'id'     => $this->id,
            'name'   => $this->name,
            'code'   => $this->code,
            'logo'   => $this->logo,
            'active' => $this->active,
            'business_id' => $this->business_id
        ];
    }
    public function setAtive(){
        $this->active = true;
    }
    public function setDeactive(){
        $this->active = false;
    }
}