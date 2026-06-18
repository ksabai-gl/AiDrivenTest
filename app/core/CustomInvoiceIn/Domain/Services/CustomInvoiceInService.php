<?php

namespace Core\CustomInvoiceIn\Domain\Services;

use App\Exceptions\BadException;
use Core\CustomInvoiceIn\Domain\Entities\CustomInvoiceIn;

interface CustomInvoiceInService
{
    public function create(array $data): CustomInvoiceIn | BadException;
    public function update(array $data): CustomInvoiceIn | BadException;
    public function delete(array $data): CustomInvoiceIn | BadException;
}