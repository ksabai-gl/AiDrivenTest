<?php

namespace Core\Supplier\Application\DTOs;

class CreateSupplierRequest
{
    public function __construct(
        public int $business_id,
        public string $unit_name,
        public ?string $email = null,
        public ?string $phone = null,
        public ?string $address = null,
        public ?string $tax_code = null,
        public ?string $bank_name = null,
        public ?string $bank_account = null,
        public ?string $website = null,
        public ?string $note = null,
        public ?bool $active = false,
        public ?int $id = null,
        public ?int $created_by = null
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            business_id: $data['business_id'] ?? 0,
            unit_name: $data['unit_name'] ?? '',
            email: $data['email'] ?? null,
            phone: $data['phone'] ?? null,
            address: $data['address'] ?? null,
            tax_code: $data['tax_code'] ?? null,
            bank_name: $data['bank_name'] ?? null,
            bank_account: $data['bank_account'] ?? null,
            website: $data['website'] ?? null,
            note: $data['note'] ?? null,
            active: $data['active'] ?? false,
            id: $data['id'] ?? null,
            created_by : $data['user_id'] ?? null  
        );
    }

    public function toArray(): array
    {
        return [
            'business_id'   => $this->business_id,
            'unit_name'     => $this->unit_name,
            'email'         => $this->email,
            'phone'         => $this->phone,
            'address'       => $this->address,
            'tax_code'      => $this->tax_code,
            'bank_name'     => $this->bank_name,
            'bank_account'  => $this->bank_account,
            'website'       => $this->website,
            'note'          => $this->note,
            'active'        => $this->active,
            'id'            => $this->id,
            'created_by'    => $this->created_by
        ];
    }
}
