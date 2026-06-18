<?php

namespace Core\StockOut\Domain\Entities;

use Carbon\Carbon;

class StockOut
{
    public function __construct(
        public ?int $id,
        public int $business_id,
        public int $invoice_out_id,
        public ?int $approved_by = null,
        public ?string $deleted_at = null,
        public ?string $status = null
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            id: $data['id'] ?? null,
            business_id: $data['business_id'],
            invoice_out_id: $data['invoice_out_id'],
            approved_by: $data['approved_by'] ?? null,
            deleted_at: $data['deleted_at'] ?? null,
            status: $data['status'] ?? null 
        );
    }

    public function toArray(): array
    {
        return [
            'id'             => $this->id,
            'business_id'    => $this->business_id,
            'invoice_out_id' => $this->invoice_out_id,
            'approved_by'    => $this->approved_by,
            'deleted_at'     => $this->deleted_at,
            'status'         => $this->status   
        ];
    }
    public function markShipped(){
        $this->status = 'shipped';
    }
    public function isShipped(): bool{
       return $this->status === 'shipped' ? true : false;
    }
    public function markPending(){
        $this->status = 'pending';
    }
    public function markCancelled(){
        $this->status = 'cancelled';
    }
    public function isPending(): bool{
        return $this->status === 'pending' ? true : false;
    }
    public function isCancelled(): bool{
        return $this->status === 'cancelled' ? true : false;
    }
    public function markCompleted(){
        $this->status = 'completed';
    }
    public function isCompleted(): bool{
        return $this->status === 'completed' ? true : false;
    }
    public function getStatus(){
        return $this->status;
    }
    public function removeApprovedBy(){
        $this->approved_by = null;
    }
}
