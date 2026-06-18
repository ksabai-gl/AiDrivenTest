<?php

namespace Core\InvoiceOut\Domain\Entities;

use Carbon\Carbon;

class InvoiceOut
{
    public function __construct(
        public ?int $id,
        public int $business_id,
        public ?string $document_no,
        public ?int $order_id,
        public float $subtotal,
        public float $tax,
        public float $discount,
        public float $total,
        public ?string $invoice_date,
        public ?string $due_date,
        public ?string $payment_status,
        public bool $approved,
        public ?string $image = null,
        public ?float $amount_paid = 0
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            id: $data['id'] ?? null,
            business_id: $data['business_id'],
            document_no: $data['document_no'] ?? null,
            order_id: $data['order_id'] ?? null,
            subtotal: (float)$data['subtotal'],
            tax: (float)$data['tax'],
            discount: (float)$data['discount'],
            total: (float)$data['total'],
            invoice_date: $data['invoice_date'] ?? null,
            due_date: $data['due_date'] ?? null,
            payment_status: $data['payment_status'] ?? null,
            approved: $data['approved'],
            image: $data['image'],
            amount_paid: $data['amount_paid'] ?? 0
        );
    }

    public function toArray(): array
    {
        return [
            'id'           => $this->id,
            'business_id'  => $this->business_id,
            'document_no'  => $this->document_no,
            'order_id'     => $this->order_id,
            'subtotal'     => $this->subtotal,
            'tax'          => $this->tax,
            'discount'     => $this->discount,
            'total'        => $this->total,
            'invoice_date' => $this->invoice_date,
            'due_date'     => $this->due_date,
            'payment_status'    => $this->payment_status,
            'approved'     => $this->approved,
            'image'        => $this->image,
            'amount_paid'  => $this->amount_paid
        ];
    }
    public function setDocumentNo(){
        $this->document_no  = 'INV-'.$this->business_id.'-' . Carbon::now()->format('Ymd-His');
    }
    public function setInvoiceDate(){
        $this->invoice_date = Carbon::now()->format('Y-m-d');
    }
    public function setDueDate(){
        $this->due_date = Carbon::now()->format('Y-m-d');
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
    public function isApproved(){
        return $this->approved;
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
