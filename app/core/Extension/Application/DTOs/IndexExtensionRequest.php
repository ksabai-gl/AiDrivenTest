<?php

namespace Core\Extension\Application\DTOs;

class IndexExtensionRequest
{
    public function __construct(
        public int $user_id,
        public int $business_id,
        public ?string $keywords = null
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            user_id: $data['user_id'],
            business_id: $data['business_id'],
            keywords: $data['keywords'] ?? null 
        );
    }
    public function toArray(): array
    {
        return [
            'user_id' => $this->user_id,
            'business_id' => $this->business_id,
            'keywords' => $this->keywords
        ];
    }
}