<?php

namespace Core\InvoiceIn\Application\UseCases;

use Core\InvoiceIn\Application\DTOs\CreateInvoiceInRequest;
use Core\InvoiceIn\Domain\Entities\InvoiceIn;
use Core\InvoiceIn\Domain\Services\InvoiceInService;

class GetInvoiceInByPurchaseId
{
    public function __construct(private InvoiceInService $service) {}

    public function handle(array $dto): ?InvoiceIn 
    {
        return $this->service->getByPurchaseId($dto);
    }
}