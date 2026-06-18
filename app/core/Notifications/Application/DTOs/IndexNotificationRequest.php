<?php

namespace Core\Notifications\Application\DTOs;

class IndexNotificationRequest
{
    public function __construct(
        public int $user_id,
        public ?int $is_not_read = null,
        public ?int $get_type = null,
        public ?string $type = null,
        public int $business_id  
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            user_id: $data['user_id'],
            is_not_read: $data['is_not_read'] ?? null,
            get_type: $data['get_type'] ?? null,
            type : $data['type'] ?? null,
            business_id: $data['business_id']  
        );
    }
    
    public function toArray(): array
    {
        return [
            'user_id' => $this->user_id,
            'is_not_read'   => $this->is_not_read,
            'get_type'  => $this->get_type,
            'type'  => $this->type,
            'business_id'   => $this->business_id
        ];
        
    }
}
