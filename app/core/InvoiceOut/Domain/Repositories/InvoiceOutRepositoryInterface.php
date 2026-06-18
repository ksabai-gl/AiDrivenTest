<?php

namespace Core\InvoiceOut\Domain\Repositories;

use Core\InvoiceOut\Domain\Entities\InvoiceOut;

interface InvoiceOutRepositoryInterface
{
    public function create(InvoiceOut $entity): InvoiceOut;
    public function findById(array $data) : ?InvoiceOut;
    public function findByOrderId(array $data) : ?InvoiceOut;
    public function findWithFullData(array $data) : ?array;
    public function update(InvoiceOut $entity) : InvoiceOut;
}