<?php

namespace Core\CustomInvoiceOut\Domain\Services;

use App\Exceptions\BadException;
use Core\CustomInvoiceOut\Domain\Entities\CustomInvoiceOut;

interface CustomInvoiceOutService
{
    public function create(array $data): CustomInvoiceOut | BadException;
    public function update(array $data): CustomInvoiceOut | BadException;
    public function delete(array $data): CustomInvoiceOut | BadException;
}