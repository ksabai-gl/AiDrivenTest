<?php

namespace Core\StockIn\Application\DTOs;

class ShowStockInRequest
{
    public function __construct(
        public int $business_id,
        public int $created_by,
        public int $id,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            business_id: (int) $data['business_id'],
            id : $data['id'],
            created_by: $data['user_id'],
        );
    }

    public function toArray(): array
    {
        return [
            'business_id' => $this->business_id,
            'id'      => $this->id,
            'created_by'  => $this->created_by,
        ];
    }
}
