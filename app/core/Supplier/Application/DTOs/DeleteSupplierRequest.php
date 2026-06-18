<?php

namespace Core\Supplier\Application\DTOs;

class DeleteSupplierRequest {
    public function __construct(
        public int $id,
        public int $business_id,
        public int $created_by
    )
    {
        
    }
    public static function fromArray(array $data): self{
        return new self(
            id: $data['id'],
            business_id: $data['business_id'],
            created_by: $data['user_id']  
        );
    }
    public function toArray(){
        return [
            'id' => $this->id,
            'business_id'   => $this->business_id,
            'created_by'    => $this->created_by
        ];
    }
}