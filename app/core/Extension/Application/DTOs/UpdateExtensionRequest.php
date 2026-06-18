<?php

namespace Core\Extension\Application\DTOs;

class UpdateExtensionRequest
{

    public function __construct(
        public bool $status,
        public ?int $id = null,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            status: $data['status'],
            id: $data['id'],
        );
    }

    public function toArray(): array
    {
        return [
            'status'    => $this->status,
            'id'=> $this->id
        ];
    }
}