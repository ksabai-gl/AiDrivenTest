<?php

namespace Core\AppToken\Application\DTOs;

class CreateAppTokenRequest
{
        public function __construct(
        public array $data,
        public ?int $id = null,
        public int $exp = 1
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            data: $data['data'],
            id: $data['id'] ?? null,
            exp: $data['exp'] ?? 1 
        );
    }
    public function toArray(): array
    {
        return [
            'data' => $this->data,
            'id' => $this->id,
            'exp'   => $this->exp
        ];
    }
}