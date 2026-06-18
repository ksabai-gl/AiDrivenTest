<?php

namespace Core\PurchaseCancel\Infrastructure\Services;

use Core\PurchaseCancel\Domain\Services\PurchaseCancelService;
use Core\PurchaseCancel\Domain\Repositories\PurchaseCancelRepositoryInterface;
use Core\PurchaseCancel\Domain\Entities\PurchaseCancel;

class PurchaseCancelServiceImpl implements PurchaseCancelService
{
    public function __construct(private PurchaseCancelRepositoryInterface $repo) {}

    public function create(array $data): PurchaseCancel
    {
        $entity = PurchaseCancel::fromArray($data);

        return $this->repo->create($entity);
    }
}