<?php

namespace Core\InvoiceIn\Domain\Repositories;

use Core\InvoiceIn\Domain\Entities\InvoiceIn;

interface InvoiceInRepositoryInterface
{
    public function create(InvoiceIn $entity): InvoiceIn;
    public function all(array $data) : array;
    public function update(InvoiceIn $entity): InvoiceIn;
    public function checkExists(array $data) : bool;
    public function findById(array $data) : ?InvoiceIn;
    public function findByIdWithFullData(array $data) : ?array;
    public function findByPurchaseId(array $data) :?InvoiceIn;
}