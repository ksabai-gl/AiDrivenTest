<?php

namespace Core\Purchase\Application\DTOs;

class UpdatePurchaseRequest 
{
    public function __construct(
        public int $business_id,
        public ?int $supplier_id = null,
        public ?int $created_by = null,
        public ?int $approved_by = null,
        public ?string $purchase_date = null,
        public ?string $expected_date = null,
        public ?string $note = null,
        public string $status = 'draft',
        public float $shipping_fee = 0,
        public ?string $payment_method = null,
        public ?int $id,
        public ?string $reason = null
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            business_id: $data['business_id'] ?? 0,
            supplier_id: $data['supplier_id'] ?? 0,
            created_by: $data['user_id'] ?? 0,
            approved_by: $data['user_id'] ?? null,
            purchase_date: $data['purchase_date'] ?? null,
            expected_date: $data['expected_date'] ?? null,
            note: $data['note'] ?? null,
            status: $data['status'] ?? 'draft',
            shipping_fee: (float) ($data['shipping_fee'] ?? 0),
            payment_method: $data['payment_method'] ?? null,
            id: $data['id'] ?? null,
            reason: $data['reason'] ?? null
        );
    }

    public function toArray(): array
    {
        return [
            'business_id'   => $this->business_id,
            'supplier_id'   => $this->supplier_id,
            'created_by'    => $this->created_by,
            'approved_by'   => $this->approved_by,
            'purchase_date' => $this->purchase_date,
            'expected_date' => $this->expected_date,
            'note'          => $this->note,
            'status'        => $this->status,
            'shipping_fee'  => $this->shipping_fee,
            'payment_method'=> $this->payment_method,
            'id'    => $this->id,
            'reason'  => $this->reason
        ];
    }
}