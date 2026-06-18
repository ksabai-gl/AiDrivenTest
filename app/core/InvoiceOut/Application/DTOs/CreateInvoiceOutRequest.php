<?php

namespace Core\InvoiceOut\Application\DTOs;

class CreateInvoiceOutRequest
{
    public function __construct(
        public int $business_id,
        public ?string $document_no = null,
        public int $order_id,
        public float $subtotal,
        public float $tax,
        public float $discount,
        public float $total,
        public ?string $invoice_date,
        public ?string $due_date,
        public ?int $id = null,
        public ?string $payment_status = null,
        public bool $approved,
        public ?int $created_by,
        public ?string $image = null,
        public ?float $amount_paid = 0  
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            business_id: (int)$data['business_id'],
            document_no: $data['document_no'] ?? null,
            order_id: $data['order_id'],
            subtotal: $data['subtotal'],
            tax: $data['tax'],
            discount: $data['discount'],
            total: $data['total'],
            invoice_date: $data['invoice_date'] ?? null,
            due_date: $data['due_date'] ?? null,
            id: $data['id'] ?? null,
            payment_status: $data['payment_status'] ?? 'pending',
            approved: $data['approved'] ?? false,
            created_by: $data['user_id'] ?? null,
            image: $data['image'] ?? null,
            amount_paid: $data['amount_paid'] ?? 0 
        );
    }

    public function toArray(): array
    {
        return [
            'business_id'  => $this->business_id,
            'document_no'  => $this->document_no,
            'order_id'     => $this->order_id,
            'subtotal'     => $this->subtotal,
            'tax'          => $this->tax,
            'discount'     => $this->discount,
            'total'        => $this->total,
            'invoice_date' => $this->invoice_date,
            'due_date'     => $this->due_date,
            'id' => $this->id,
            'payment_status' => $this->payment_status,
            'approved'     => $this->approved,
            'created_by'   => $this->created_by,
            'image' => $this->image,
            'amount_paid' => $this->amount_paid 
        ];
    }
}
