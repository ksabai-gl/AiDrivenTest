<?php

namespace Core\Business\Application\DTOs;

class ShowBusinessRequest
{
    public function __construct(
        public ?int $id = null  
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            id: $data['id'] ?? null
        );
    }
    public function toArray() : array{
        return [
            'id' => $this->id
        ];
    }
}