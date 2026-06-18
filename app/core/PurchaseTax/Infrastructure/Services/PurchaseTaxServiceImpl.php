<?php

namespace Core\PurchaseTax\Infrastructure\Services;

use Core\PurchaseTax\Domain\Services\PurchaseTaxService;
use Core\PurchaseTax\Domain\Repositories\PurchaseTaxRepositoryInterface;
use Core\PurchaseTax\Domain\Entities\PurchaseTax;

class PurchaseTaxServiceImpl implements PurchaseTaxService
{
    public function __construct(private PurchaseTaxRepositoryInterface $repo) {}

    public function create(array $data): PurchaseTax
    {
        $entity = PurchaseTax::fromArray($data);

        return $this->repo->create($entity);
    }
}