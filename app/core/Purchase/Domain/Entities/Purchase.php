<?php

namespace Core\Purchase\Domain\Entities;

use Carbon\Carbon;

class Purchase
{
    public ?int $id = null;
    public string $status = 'draft';
    public function __construct(
        public int $business_id,
        public ?int $supplier_id = null,
        public ?int $created_by = null,
        public ?int $approved_by = null,
        public ?string $purchase_date = null,
        public ?string $expected_date = null,
        public ?string $note = null,
        public float $shipping_fee = 0,
        public ?string $payment_method = null
    ) {}

    public function toArray(): array
    {
        return [
            'id'             => $this->id,
            'business_id'    => $this->business_id,
            'supplier_id'    => $this->supplier_id,
            'created_by'     => $this->created_by,
            'approved_by'    => $this->approved_by,
            'purchase_date'  => $this->purchase_date,
            'expected_date'  => $this->expected_date,
            'note'           => $this->note,
            'status'         => $this->status,
            'shipping_fee'   => $this->shipping_fee,
            'payment_method' => $this->payment_method
        ];
    }

    public static function fromArray(array $data): self
    {
        $entity = new self(
            business_id: $data['business_id'] ?? 0,
            supplier_id: $data['supplier_id'] ?? null,
            created_by: $data['created_by'] ?? null,
            approved_by: $data['approved_by'] ?? null,
            purchase_date: Carbon::parse($data['purchase_date'])->format('Y-m-d') ?? null,
            expected_date: Carbon::parse($data['expected_date'])->format('Y-m-d') ?? null,
            note: $data['note'] ?? null,
            shipping_fee: (float)($data['shipping_fee'] ?? 0),
            payment_method: $data['payment_method'] ?? null
        );
        if (!empty($data['status'])) {
            $entity->status = $data['status'];
        }
        if (!empty($data['id'])) {
            $entity->id = $data['id'];
        }
        return $entity;
    }

    public function setDraft()
    {
        $this->status = 'draft';
    }
    public function setRequested()
    {
        $this->status = 'requested';
    }
    public function setApproved()
    {
        $this->status = 'approved';
    }
    public function setCancelled()
    {
        $this->status = 'cancelled';
    }
    public function makePurchase(): Purchase
    {
        return $this;
    }
    public function isDraft()
    {
        return $this->status === 'draft' ? true : false;
    }
    public function isRequested()
    {
        return $this->status === 'requested' ? true : false;
    }
    public function isApproved()
    {
        return $this->status === 'approved' ? true : false;
    }
    public function isCancelled()
    {
        return $this->status === 'cancelled' ? true : false;
    }
    public function getStatus() : string {
        return $this->status;
    }
}
