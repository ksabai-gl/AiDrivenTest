<?php

namespace Core\CustomInvoiceOut\Domain\Entities;

class CustomInvoiceOut
{
    public function __construct(
        public int $createdBy,
        public int $business_id,
        public string $description,
        public float $amount,
        public ?string $invoice_date,
        public ?bool $approved = null,
        public string $payment_status = 'pending',
        public ?int $id = null,
        public ?string $document_no = null,
        public ?int $customer_id 
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            createdBy: (int) $data['created_by'],
            business_id: (int) $data['business_id'],
            description: $data['description'],
            amount: (float) $data['amount'],
            invoice_date: $data['invoice_date'],
            approved: $data['approved'] ?? null,
            payment_status: $data['payment_status'] ?? 'pending',
            id: $data['id'] ?? null,
            document_no: $data['document_no'] ?? null,
            customer_id: $data['customer_id'] 
        );
    }

    public function toArray(): array
    {
        return [
            'created_by' => $this->createdBy,
            'business_id' => $this->business_id,
            'description' => $this->description,
            'amount' => $this->amount,
            'invoice_date' => $this->invoice_date,
            'approved' => $this->approved,
            'payment_status' => $this->payment_status,
            'id'    => $this->id,
            'document_no'   => $this->document_no,
            'customer_id'   => $this->customer_id
        ];
    }
    public function markApproved(){
        $this->approved = true;
    }
    public function markUnApproved(){
        $this->approved = false;
    }
    public function isApproved() : bool {
        return $this->approved;
    }
    public function makeDocumentNo(){
        $this->document_no ??= 'INV-CI'.$this->business_id.'-' . date('YmdHis',time());
    }
}
