<?php

namespace Core\AppToken\Domain\Entities;

class AppToken
{
    public function __construct(
        public array $data,
        public ?int $id = null
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            data: $data['data'],
            id: $data['id'] ?? null 
        );
    }
    public function toArray(): array
    {
        return [
            'data' => $this->data,
            'id' => $this->id
        ];
    }
}