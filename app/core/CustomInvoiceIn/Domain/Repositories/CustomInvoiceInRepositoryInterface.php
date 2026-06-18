<?php

namespace Core\CustomInvoiceIn\Domain\Repositories;

use App\Exceptions\BadException;
use Core\CustomInvoiceIn\Domain\Entities\CustomInvoiceIn;

interface CustomInvoiceInRepositoryInterface
{
    public function create(CustomInvoiceIn $entity): CustomInvoiceIn;
    public function update(CustomInvoiceIn $entity): CustomInvoiceIn;
    public function findById(array $data): ?CustomInvoiceIn;
    public function findByDocumentNo(array $data): ?CustomInvoiceIn;
    public function delete(CustomInvoiceIn $entity): CustomInvoiceIn;
}