<?php

namespace Core\CustomInvoiceIn\Domain\Entities;

class CustomInvoiceIn
{
    public function __construct(
        public int $supplier_id,
        public int $business_id,
        public int $created_by,

        public ?string $document_no,
        public string $description,

        public float $amount,
        public string $invoice_date,

        public string $payment_status,
        public ?int $id = null,
        public bool $approved  
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            supplier_id: (int) $data['supplier_id'],
            business_id: (int) $data['business_id'],
            created_by: (int) $data['created_by'],

            document_no: $data['document_no'] ?? null,
            description: $data['description'],

            amount: (float) $data['amount'],
            invoice_date: $data['invoice_date'],

            payment_status: $data['payment_status'],
            id: $data['id'] ?? null,
            approved: $data['approved'] 
        );
    }

    public function toArray(): array
    {
        return [
            'supplier_id' => $this->supplier_id,
            'business_id' => $this->business_id,
            'created_by' => $this->created_by,

            'document_no' => $this->document_no,
            'description' => $this->description,

            'amount' => $this->amount,
            'invoice_date' => $this->invoice_date,

            'payment_status' => $this->payment_status,
            'id'    => $this->id,
            'approved'  => $this->approved
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