<?php

namespace Core\PurchaseItem\Application\UseCases;

use Core\PurchaseItem\Application\DTOs\FindPurchaseItemByIdRequest;
use Core\PurchaseItem\Domain\Entities\PurchaseItem;
use Core\PurchaseItem\Domain\Services\PurchaseItemService;

class FindPurchaseItemById
{
    public function __construct(private PurchaseItemService $service) {}

    public function handle(FindPurchaseItemByIdRequest $dto) : PurchaseItem
    {
        
        return $this->service->findById($dto->toArray());
    }
}