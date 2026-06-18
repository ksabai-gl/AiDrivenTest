<?php

namespace Core\InvoiceIn\Application\DTOs;

class CreateInvoiceInRequest
{
    public function __construct(
        public int $business_id,
        public ?string $document_no = null,
        public int $purchase_id,
        public ?int $approved_by = null,
        public float $subtotal = 0,
        public float $tax = 0,
        public float $discount = 0,
        public float $total = 0,
        public ?string $invoice_date = null,
        public ?string $due_date = null,
        public ?bool $approved = null,
        public ?string $payment_status,
        public ?int $id = null,
        public ?int $created_by,
        public ?string $image = null,
        public ?float $amount_paid = 0 
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            business_id: $data['business_id'],
            document_no: $data['document_no'] ?? null,
            purchase_id: $data['purchase_id'],
            approved_by: $data['user_id'] ?? null,
            subtotal: (float) ($data['subtotal'] ?? 0),
            tax: (float) ($data['total_tax'] ?? 0),
            discount: (float) ($data['discount'] ?? 0),
            total: (float) ($data['total'] ?? 0),
            invoice_date: $data['invoice_date'] ?? null,
            due_date: $data['due_date'] ?? null,
            approved: $data['approved'] ?? null,
            payment_status : $data['payment_status'] ?? null,
            id: $data['id'] ?? null,
            created_by: $data['user_id'] ?? null,
            image: $data['image'] ?? null,
            amount_paid: $data['amount_paid'] ?? 0  
        );
    }

    public function toArray(): array
    {
        return [
            'business_id' => $this->business_id,
            'document_no' => $this->document_no,
            'purchase_id' => $this->purchase_id,
            'approved_by' => $this->approved_by,
            'subtotal' => $this->subtotal,
            'tax' => $this->tax,
            'discount' => $this->discount,
            'total' => $this->total,
            'invoice_date' => $this->invoice_date,
            'due_date' => $this->due_date,
            'approved' => $this->approved,
            'payment_status' => $this->payment_status,
            'id'    => $this->id,
            'created_by'    => $this->created_by,
            'image' => $this->image,
            'amount_paid'   => $this->amount_paid
        ];
    }
}
