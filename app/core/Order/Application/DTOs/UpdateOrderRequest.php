<?php

namespace Core\Order\Application\DTOs;

class UpdateOrderRequest
{
    public function __construct(
        public int $business_id,
        public int $created_by,
        public ?int $customer_id = null,
        public ?string $expected_delivery_date = null,
        public ?string $note = null,
        public string $type = 'retail',
        public ?int $id,
        public ?string $order_no = null,
        public ?string $status = null,
        public ?string $reason = null 
    ) {}

    /**
     * Build DTO from array
     */
    public static function fromArray(array $data): self
    {
        return new self(
            business_id:             $data['business_id'],
            created_by:              $data['user_id'],
            customer_id:             $data['customer_id'] ?? null,
            expected_delivery_date:  $data['expected_delivery_date'] ?? null,
            note:                    $data['note'] ?? null,
            type:                    $data['type'] ?? 'retail',
            id:                      $data['id'] ?? null,
            order_no:                 $data['order_no'] ?? null,
            status: $data['status'] ?? null,
            reason: $data['reason'] ?? null 
        );
    }

    /**
     * Convert to array (for Entity or Repository)
     */
    public function toArray(): array
    {
        return [
            'business_id'            => $this->business_id,
            'customer_id'            => $this->customer_id,
            'expected_delivery_date' => $this->expected_delivery_date,
            'note'                   => $this->note,
            'type'                   => $this->type,
            'created_by' => $this->created_by,
            'id' => $this->id,
            'order_no' => $this->order_no,
            'status'   => $this->status,
            'reason'   => $this->reason
        ];
    }
}
