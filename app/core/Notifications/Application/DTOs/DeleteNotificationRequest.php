<?php

namespace Core\Notifications\Application\DTOs;

class DeleteNotificationRequest
{
    public function __construct(
        public int $id,
        public int $user_id,
        public int $business_id
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            id: $data['id'],
            user_id: $data['user_id'],
            business_id: $data['business_id']
        );
    }
    
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'user_id'   => $this->user_id,
            'business_id'   => $this->business_id
        ];
        
    }
}
