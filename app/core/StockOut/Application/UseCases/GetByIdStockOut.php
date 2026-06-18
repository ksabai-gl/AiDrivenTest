<?php

namespace Core\StockOut\Application\UseCases;

use Core\StockOut\Application\DTOs\CreateStockOutRequest;
use Core\StockOut\Domain\Entities\StockOut;
use Core\StockOut\Domain\Services\StockOutService;

class GetByIdStockOut
{
    public function __construct(private StockOutService $service) {}

    public function handle(array $dto) : StockOut
    {
        return $this->service->getById($dto);
    }
}