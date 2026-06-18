<?php

namespace Core\PriceList\Application\DTOs;

class DeletePriceListRequest
{
    public function __construct(
        public int $created_by,
        public int $business_id,
        public int $id
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            created_by: $data['user_id'],
            business_id: $data['business_id'],
            id: $data['id']
        );
    }

    public function toArray(): array
    {
        return [
            'created_by'        => $this->created_by,
            'business_id'       => $this->business_id,
            'id'    => $this->id
        ];
    }
}
