<?php

namespace Core\Notifications\Domain\Entities;

use Carbon\Carbon;

class Notification
{
    public function __construct(
        public string $user_id,
        public ?string $message = null,
        public ?string $link = null,
        public ?string $title = null,
        public ?string $entity_type,
        public ?int $entity_id,
        public ?int $id = null,
        public string $type = 'default',
        public ?bool $is_read = false,
        public int $business_id
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            user_id: $data['user_id'],
            message: $data['message'] ?? null,
            link: $data['link'] ?? null,        
            title: $data['title'] ?? null,      
            entity_type: $data['entity_type'] ?? null,
            entity_id: $data['entity_id'] ?? null,
            id : $data['id'] ?? null,
            type: $data['type'] ?? 'default',
            is_read: $data['is_read'] ?? false,
            business_id: $data['business_id']    
        );
    }
    
    public function toArray(): array
    {
        return [
            'user_id' => $this->user_id,
            'message' => $this->message,
            'link'    => $this->link, 
            'title'   => $this->title,
            'entity_type' => $this->entity_type,
            'entity_id' => $this->entity_id,
            'id'    => $this->id,
            'type'  => $this->type,
            'is_read'   => $this->is_read,
            'business_id'   => $this->business_id
        ];
    }
    public function markRead(){
        $this->is_read = true;
    }
}