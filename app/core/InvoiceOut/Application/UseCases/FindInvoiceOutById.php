<?php

namespace Core\InvoiceOut\Application\UseCases;

use Core\InvoiceOut\Application\DTOs\CreateInvoiceOutRequest;
use Core\InvoiceOut\Domain\Services\InvoiceOutService;

class FindInvoiceOutById
{
    public function __construct(private InvoiceOutService $service) {}

    public function handle(array $dto)
    {
        return $this->service->findById($dto);
    }
}