<?php

namespace Core\Authencation\Application\DTOs;

class ForgetAuthencationRequest
{
    public function __construct(
        public string $email
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            email: $data['email']
        );
    }
    public function toArray(): array
    {
        return [
            'email' => $this->email
        ];
    }
}