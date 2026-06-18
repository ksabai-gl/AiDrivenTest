<?php

namespace Core\InvoiceIn\Domain\Entities;

use Carbon\Carbon;

class InvoiceIn
{
    public function __construct(
        public ?int $id,
        public int $business_id,
        public ?string $document_no = null,
        public ?int $purchase_id = null,
        public ?int $approved_by = null,
        public float $subtotal = 0,
        public float $tax = 0,
        public float $discount = 0,
        public float $total = 0,
        public ?string $invoice_date = null,
        public ?string $due_date = null,
        public bool $approved,
        public string $payment_status,
        public ?string $image = null,
        public ?float $amount_paid = 0 
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            id: $data['id'] ?? null,
            business_id: $data['business_id'],
            document_no: $data['document_no'] ?? null,
            purchase_id: $data['purchase_id'] ?? null,
            approved_by: $data['user_id'] ?? null,
            subtotal: (float) ($data['subtotal'] ?? 0),
            tax: (float) ($data['tax'] ?? 0),
            discount: (float) ($data['discount'] ?? 0),
            total: (float) ($data['total'] ?? 0),
            invoice_date: !empty($data['invoice_date']) ? Carbon::parse($data['invoice_date'])->format('Y-m-d') : null,
            due_date: !empty($data['due_date']) ? Carbon::parse($data['due_date'])->format('Y-m-d') : null,
            approved: $data['approved'] ?? false,
            payment_status : $data['payment_status'] ?? 'pending',
            image: $data['image'] ?? null,
            amount_paid: $data['amount_paid'] ?? 0 
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
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
            'image' => $this->image,
            'amount_paid' => $this->amount_paid
        ];
    }
    public function markApproved(){
        $this->approved = true;
    }
    public function markUnApproved(){
        $this->approved = false;
    }
    public function markPaid(){
        $this->payment_status = 'paid';
    }
    public function markPartialPayment(){
        $this->payment_status = 'partial_payment';
    }
    public function markPending(){
        $this->payment_status = 'pending';
    }
    public function markAmountPaid(){
        $this->amount_paid = $this->total;
    }
    public function isPaid() : bool{
        return $this->payment_status === 'paid' ? true : false;
    }
    public function isPartialPayment() : bool {
        return $this->payment_status === 'partial_payment' ? true : false;
    }
    public function isPending() : bool{
        return $this->payment_status === 'pending' ? true : false;
    }
    public function isApproved() : bool{
        return $this->approved;
    }
    public function makeDocumentNo(){
        $this->document_no = 'INV-' . ($this->business_id ?? 0) . date('Ymd-His',time());
    }
    public function checkAmountPaidValid() : bool {
        if($this->payment_status === 'partial_payment') {
            if(floatval($this->amount_paid) === 0.00) {
                return false;
            } 
            if(floatval($this->amount_paid) >= floatval($this->total)) {
                return false;
            }
        }
        return true;
    }
}
