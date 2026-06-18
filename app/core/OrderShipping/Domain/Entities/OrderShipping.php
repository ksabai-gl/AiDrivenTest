<?php

namespace Core\OrderShipping\Domain\Entities;

class OrderShipping
{
    public function __construct(
        public ?int $id,
        public int $order_id,
        public ?string $receiver_name,
        public ?string $receiver_phone,
        public ?string $receiver_address,
        public ?string $receiver_note,
        public ?int $preferred_unit = null,               
        public int $shipping_fee_estimated = 0,    
        public ?string $shipping_code = null,
        public int $shipping_fee_actual = 0,
        public ?string $shipped_at = null,
        public ?string $delivered_at = null
    ) {}

    /**
     * Convert array → Entity
     */
    public static function fromArray(array $data): self
    {
        return new self(
            id: $data['id'] ?? null,
            order_id: $data['order_id'],
            receiver_name: $data['receiver_name'] ?? null,
            receiver_phone: $data['receiver_phone'] ?? null,
            receiver_address: $data['receiver_address'] ?? null,
            receiver_note: $data['receiver_note'] ?? null,
            preferred_unit: $data['preferred_unit'] ?? null,
            shipping_fee_estimated: $data['shipping_fee_estimated'] ?? 0,
            shipping_code: $data['shipping_code'] ?? null,
            shipping_fee_actual: $data['shipping_fee_actual'] ?? 0,
            shipped_at: $data['shipped_at'] ?? null,
            delivered_at: $data['delivered_at'] ?? null
        );
    }

    /**
     * Convert Entity → array
     */
    public function toArray(): array
    {
        return [
            'id'                      => $this->id,
            'order_id'                => $this->order_id,
            'receiver_name'           => $this->receiver_name,
            'receiver_phone'          => $this->receiver_phone,
            'receiver_address'        => $this->receiver_address,
            'receiver_note'           => $this->receiver_note,
            'preferred_unit'          => $this->preferred_unit,
            'shipping_fee_estimated'  => $this->shipping_fee_estimated,
            'shipping_code'           => $this->shipping_code,
            'shipping_fee_actual'     => $this->shipping_fee_actual,
            'shipped_at'              => $this->shipped_at,
            'delivered_at'            => $this->delivered_at
        ];
    }
    public function isReady() : bool {
        return $this->preferred_unit ? true : false;
    }
    public function isFeeActualApplied(){
        if($this->shipping_fee_actual > 0) {
            $this->shipping_fee_estimated = 0;
        }
    }
}
