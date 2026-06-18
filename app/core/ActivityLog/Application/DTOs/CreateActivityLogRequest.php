<?php

namespace Core\ActivityLog\Application\DTOs;

class CreateActivityLogRequest
{
    public function __construct(
        public int $user_id,
        public string $action,
        public ?string $description = null,
        public string $entity_type,
        public int $entity_id,
        public int $business_id
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            user_id: $data['user_id'],
            action: $data['action'],
            description: json_encode($data['description']) ?? '',
            entity_type: $data['entity_type'],
            entity_id: $data['entity_id'],
            business_id: $data['business_id'],
        );
    }

    public function toArray(): array
    {
        return [
            'user_id'     => $this->user_id,
            'action'      => $this->action,
            'description' => $this->description,
            'entity_type' => $this->entity_type,
            'entity_id'   => $this->entity_id,
            'business_id' => $this->business_id
        ];
    }

}
