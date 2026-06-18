<?php

namespace Core\Authencation\Application\DTOs;

class WebSessionTokenRequest
{
    public function __construct(
        public string $token
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            token: $data['token']
        );
    }
    public function toArray(): array
    {
        return [
            'token' => $this->token
        ];
    }
}