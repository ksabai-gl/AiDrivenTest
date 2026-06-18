<?php

namespace Core\Overview\Application\DTOs;

class CreateOverviewRequest
{
    public function __construct(
        public int $business_id
    ) {}

    /**
     * Build DTO from array
     */
    public static function fromArray(array $data): self
    {
        return new self(
            business_id:             $data['business_id']
        );
    }

    /**
     * Convert to array (for Entity or Repository)
     */
    public function toArray(): array
    {
        return [
            'business_id'            => $this->business_id
        ];
    }
}